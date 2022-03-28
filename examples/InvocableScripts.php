<?php
/**
 * Show to use Invocable scripts Cloud API to create custom endpoints that query data
 *
 * Invocable Scripts are supported only in InfluxDB Cloud, currently there is no support in InfluxDB OSS.
 */

require __DIR__ . '/../vendor/autoload.php';

use InfluxDB2\Client;
use InfluxDB2\Model\ScriptCreateRequest;
use InfluxDB2\Model\ScriptUpdateRequest;
use InfluxDB2\Point;

$organization = 'my-org';
$bucket = 'my-bucket';
$token = 'my-token';

//
// Creating client
//
$client = new Client([
    "url" => "https://us-west-2-1.aws.cloud2.influxdata.com",
    "token" => $token,
    "bucket" => $bucket,
    "org" => $organization,
    "precision" => InfluxDB2\Model\WritePrecision::S
]);

//
// Prepare data
//
$point1 = Point::measurement("my_measurement")
    ->addTag("location", "Prague")
    ->addField("temperature", 25.3);
$point2 = Point::measurement("my_measurement")
    ->addTag("location", "New York")
    ->addField("temperature", 24.3);
$client->createWriteApi()->write([$point1, $point2]);

//
// Creating InvocableScripts Api
//
$scriptsApi = $client->createInvocableScriptsApi();

//
// Create Invocable Script
//
print "\n------- Create -------\n";
$scriptQuery = 'from(bucket: params.bucket_name) |> range(start: -30d) |> limit(n:2)';
$createRequest = new ScriptCreateRequest([
    'name' => "my_script_" . microtime(),
    'description' => "my first try",
    'script' => $scriptQuery,
    'language' => InfluxDB2\Model\ScriptLanguage::FLUX,
]);
$createdScript = $scriptsApi->createScript($createRequest);
print $createdScript;

//
// Update Invocable Script
//
print "\n------- Update -------\n";
$updateRequest = new ScriptUpdateRequest([
    'description' => "my updated description"
]);
$createdScript = $scriptsApi->updateScript($createdScript->getId(), $updateRequest);
print $createdScript;

//
// List scripts
//
print "\n------- List -------\n";
$scripts = $scriptsApi->findScripts();
foreach ($scripts as $script) {
    $scriptId = $script->getId();
    $scriptName = $script->getName();
    $scriptDescription = $script->getDescription();
    print " ---\n ID: $scriptId\n Name: $scriptName\n Description: $scriptDescription";
}

//
// Delete previously created Script
//
print "\n------- Delete -------\n";
$scriptsApi->deleteScript($createdScript->getId());
print "Successfully deleted script: '" . $createdScript->getName();

$client->close();
