<?php

namespace InfluxDB2;

use InfluxDB2\Drivers\Guzzle\GuzzleApi;

/**
 * Write time series data into InfluxDB.
 *
 * @package InfluxDB2
 */
class WriteApi implements Writer
{
    public $writeOptions;
    public $pointSettings;

    private $api;
    private $options;

    /** @var Worker */
    protected $worker;
    public $closed = false;

    /**
     * WriteApi constructor.
     * @param array $options
     * @param array|null $writeOptions
     * @param array|null $pointSettings
     */
    public function __construct(array $options, array $writeOptions = null, array $pointSettings = null, DefaultApi $defaultApi = NULL)
    {
        $this->options = $options;
        $this->api = $defaultApi ?? new GuzzleApi($options);
        $this->writeOptions = new WriteOptions($writeOptions) ?: new WriteOptions();
        $this->pointSettings = new PointSettings($pointSettings) ?: new PointSettings();

        if (array_key_exists('tags', $options)) {
            foreach (array_keys($options['tags']) as $key) {
                $this->pointSettings->addDefaultTag($key, $options['tags'][$key]);
            }
        }
    }

    /**
     * Write data into specified bucket
     *
     * Example write data in array
     *      $writeApi->write([
     *          ['name' => 'cpu','tags' => ['host' => 'server_nl', 'region' => 'us'],
     *              'fields' => ['internal' => 5, 'external' => 6],
     *              'time' => 1422568543702900257],
     *          ['name' => 'gpu', 'fields' => ['value' => 0.9999]]],
     *      WritePrecision::NS,
     *      'my-bucket',
     *      'my-org'
     *      )
     *
     * Example write data in line protocol
     *      $writeApi->write('h2o,location=west value=33i 15')
     *
     * Example write data using Point structure
     *      $point = new Point("h2o).
     *
     *
     * @param string|Point|array $data DataPoints to write into InfluxDB. The data could be represent by
     * array, Point, string
     * @param string|null $precision The precision for the unix timestamps within the body line-protocol @see \InfluxDB2\Model\WritePrecision
     * @param string|null $bucket specifies the destination bucket for writes
     * @param string|null $org specifies the destination organization for writes
     * @throws ApiException
     */
    public function write($data, string $precision = null, string $bucket = null, string $org = null)
    {
        $precisionParam = $this->getOption("precision", $precision);
        $bucketParam = $this->getOption("bucket", $bucket);
        $orgParam = $this->getOption("org", $org);

        $this->api->check("precision", $precisionParam);
        $this->api->check("bucket", $bucketParam);
        $this->api->check("org", $orgParam);

        $this->addDefaultTags($data);

        $payload = WritePayloadSerializer::generatePayload($data, $precisionParam, $bucketParam, $orgParam, $this->writeOptions->writeType);

        if ($payload == null) {
            return;
        }

        if (WriteType::BATCHING == $this->writeOptions->writeType) {
            $this->worker()->push($payload);
        } else {
            $this->writeRaw($payload, $precisionParam, $bucketParam, $orgParam);
        }
    }

    private function addDefaultTags(&$data)
    {
        $defaultTags = $this->pointSettings->getDefaultTags();

        if (is_array($data)) {
            if (array_key_exists('name', $data)) {
                foreach (array_keys($defaultTags) as $key) {
                    $data['tags'][$key] = PointSettings::getValue($defaultTags[$key]);
                }
            } else {
                foreach ($data as &$item) {
                    $this->addDefaultTags($item);
                }
            }
        } elseif ($data instanceof Point) {
            foreach (array_keys($defaultTags) as $key) {
                $data->addTag($key, PointSettings::getValue($defaultTags[$key]));
            }
        }
    }

    /**
     * Writes data using line protocol.
     *
     * @param string $data payload data as string (in line protocol format)
     * @param string|null $precision The precision for the unix timestamps within the body line-protocol
     * @param string|null $bucket specifies the destination bucket for writes
     * @param string|null $org specifies the destination organization for writes
     * @throws ApiException
     *
     * @see \InfluxDB2\Model\WritePrecision
     */
    public function writeRaw(string $data, string $precision = null, string $bucket = null, string $org = null)
    {
        $precisionParam = $this->getOption("precision", $precision);
        $bucketParam = $this->getOption("bucket", $bucket);
        $orgParam = $this->getOption("org", $org);

        $this->api->check("precision", $precisionParam);
        $this->api->check("bucket", $bucketParam);
        $this->api->check("org", $orgParam);

        $queryParams = ["org" => $orgParam, "bucket" => $bucketParam, "precision" => $precisionParam];

        $this->writeRawInternal($data, $queryParams, 1, $this->writeOptions->retryInterval);
    }

    private function writeRawInternal(string $data, array $queryParams, int $attempts, int $retryInterval)
    {
        if ($this->writeOptions->jitterInterval > 0) {
            $jitterDelay = ($this->writeOptions->jitterInterval * 1000) * (rand(0, 1000) / 1000);
            usleep($jitterDelay);
        }

        try {
            $this->api->post($data, "/api/v2/write", $queryParams);
        } catch (ApiException $e) {
            $code = $e->getCode();

            if ($attempts > $this->writeOptions->maxRetries) {
                throw $e;
            }

            if (($code == null || $code < 429) &&
                !(class_exists('GuzzleHttp\Exception\ConnectException') && $e->getPrevious() instanceof \GuzzleHttp\Exception\ConnectException)
            ) {
                throw $e;
            }

            $headers = $e->getResponseHeaders();

            if ($headers != null && array_key_exists('Retry-After', $headers)) {
                $timeout = (int)$headers['Retry-After'][0] * 1000000.0;
            } else {
                $timeout = min($retryInterval, $this->writeOptions->maxRetryDelay) * 1000.0;
            }

            $timeoutInSec = $timeout / 1000000.0;
            $error = $e->getResponseBody();
            $error = isset($error) ? $error : $e->getMessage();

            $message = "The retriable error occurred during writing of data. Reason: '{$error}'. Retry in: {$timeoutInSec}s.";
            $this->api->log("WARNING", $message);

            usleep($timeout);

            $this->writeRawInternal(
                $data,
                $queryParams,
                $attempts + 1,
                $retryInterval * $this->writeOptions->exponentialBase
            );
        }
    }

    public function close()
    {
        $this->closed = true;

        $this->worker()->flush();
    }

    protected function worker(): Worker
    {
        if (!isset($this->worker)) {
            $this->worker = new Worker($this);
        }

        return $this->worker;
    }

    protected function getOption(string $optionName, string $precision = null): string
    {
        return isset($precision) ? $precision : $this->options["$optionName"];
    }
}
