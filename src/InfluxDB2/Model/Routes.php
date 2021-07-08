<?php
/**
 * Routes
 *
 * PHP version 5
 *
 * @category Class
 * @package  InfluxDB2
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Influx OSS API Service
 *
 * No description provided (generated by Openapi Generator https://github.com/openapitools/openapi-generator)
 *
 * OpenAPI spec version: 2.0.0
 * 
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 3.3.4
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace InfluxDB2\Model;

use \ArrayAccess;
use \InfluxDB2\ObjectSerializer;

/**
 * Routes Class Doc Comment
 *
 * @category Class
 * @package  InfluxDB2
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class Routes implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Routes';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'authorizations' => 'string',
        'buckets' => 'string',
        'dashboards' => 'string',
        'external' => '\InfluxDB2\Model\RoutesExternal',
        'variables' => 'string',
        'me' => 'string',
        'flags' => 'string',
        'orgs' => 'string',
        'query' => '\InfluxDB2\Model\RoutesQuery',
        'setup' => 'string',
        'signin' => 'string',
        'signout' => 'string',
        'sources' => 'string',
        'system' => '\InfluxDB2\Model\RoutesSystem',
        'tasks' => 'string',
        'telegrafs' => 'string',
        'users' => 'string',
        'write' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'authorizations' => 'uri',
        'buckets' => 'uri',
        'dashboards' => 'uri',
        'external' => null,
        'variables' => 'uri',
        'me' => 'uri',
        'flags' => 'uri',
        'orgs' => 'uri',
        'query' => null,
        'setup' => 'uri',
        'signin' => 'uri',
        'signout' => 'uri',
        'sources' => 'uri',
        'system' => null,
        'tasks' => 'uri',
        'telegrafs' => 'uri',
        'users' => 'uri',
        'write' => 'uri'
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'authorizations' => 'authorizations',
        'buckets' => 'buckets',
        'dashboards' => 'dashboards',
        'external' => 'external',
        'variables' => 'variables',
        'me' => 'me',
        'flags' => 'flags',
        'orgs' => 'orgs',
        'query' => 'query',
        'setup' => 'setup',
        'signin' => 'signin',
        'signout' => 'signout',
        'sources' => 'sources',
        'system' => 'system',
        'tasks' => 'tasks',
        'telegrafs' => 'telegrafs',
        'users' => 'users',
        'write' => 'write'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'authorizations' => 'setAuthorizations',
        'buckets' => 'setBuckets',
        'dashboards' => 'setDashboards',
        'external' => 'setExternal',
        'variables' => 'setVariables',
        'me' => 'setMe',
        'flags' => 'setFlags',
        'orgs' => 'setOrgs',
        'query' => 'setQuery',
        'setup' => 'setSetup',
        'signin' => 'setSignin',
        'signout' => 'setSignout',
        'sources' => 'setSources',
        'system' => 'setSystem',
        'tasks' => 'setTasks',
        'telegrafs' => 'setTelegrafs',
        'users' => 'setUsers',
        'write' => 'setWrite'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'authorizations' => 'getAuthorizations',
        'buckets' => 'getBuckets',
        'dashboards' => 'getDashboards',
        'external' => 'getExternal',
        'variables' => 'getVariables',
        'me' => 'getMe',
        'flags' => 'getFlags',
        'orgs' => 'getOrgs',
        'query' => 'getQuery',
        'setup' => 'getSetup',
        'signin' => 'getSignin',
        'signout' => 'getSignout',
        'sources' => 'getSources',
        'system' => 'getSystem',
        'tasks' => 'getTasks',
        'telegrafs' => 'getTelegrafs',
        'users' => 'getUsers',
        'write' => 'getWrite'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['authorizations'] = isset($data['authorizations']) ? $data['authorizations'] : null;
        $this->container['buckets'] = isset($data['buckets']) ? $data['buckets'] : null;
        $this->container['dashboards'] = isset($data['dashboards']) ? $data['dashboards'] : null;
        $this->container['external'] = isset($data['external']) ? $data['external'] : null;
        $this->container['variables'] = isset($data['variables']) ? $data['variables'] : null;
        $this->container['me'] = isset($data['me']) ? $data['me'] : null;
        $this->container['flags'] = isset($data['flags']) ? $data['flags'] : null;
        $this->container['orgs'] = isset($data['orgs']) ? $data['orgs'] : null;
        $this->container['query'] = isset($data['query']) ? $data['query'] : null;
        $this->container['setup'] = isset($data['setup']) ? $data['setup'] : null;
        $this->container['signin'] = isset($data['signin']) ? $data['signin'] : null;
        $this->container['signout'] = isset($data['signout']) ? $data['signout'] : null;
        $this->container['sources'] = isset($data['sources']) ? $data['sources'] : null;
        $this->container['system'] = isset($data['system']) ? $data['system'] : null;
        $this->container['tasks'] = isset($data['tasks']) ? $data['tasks'] : null;
        $this->container['telegrafs'] = isset($data['telegrafs']) ? $data['telegrafs'] : null;
        $this->container['users'] = isset($data['users']) ? $data['users'] : null;
        $this->container['write'] = isset($data['write']) ? $data['write'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets authorizations
     *
     * @return string|null
     */
    public function getAuthorizations()
    {
        return $this->container['authorizations'];
    }

    /**
     * Sets authorizations
     *
     * @param string|null $authorizations authorizations
     *
     * @return $this
     */
    public function setAuthorizations($authorizations)
    {
        $this->container['authorizations'] = $authorizations;

        return $this;
    }

    /**
     * Gets buckets
     *
     * @return string|null
     */
    public function getBuckets()
    {
        return $this->container['buckets'];
    }

    /**
     * Sets buckets
     *
     * @param string|null $buckets buckets
     *
     * @return $this
     */
    public function setBuckets($buckets)
    {
        $this->container['buckets'] = $buckets;

        return $this;
    }

    /**
     * Gets dashboards
     *
     * @return string|null
     */
    public function getDashboards()
    {
        return $this->container['dashboards'];
    }

    /**
     * Sets dashboards
     *
     * @param string|null $dashboards dashboards
     *
     * @return $this
     */
    public function setDashboards($dashboards)
    {
        $this->container['dashboards'] = $dashboards;

        return $this;
    }

    /**
     * Gets external
     *
     * @return \InfluxDB2\Model\RoutesExternal|null
     */
    public function getExternal()
    {
        return $this->container['external'];
    }

    /**
     * Sets external
     *
     * @param \InfluxDB2\Model\RoutesExternal|null $external external
     *
     * @return $this
     */
    public function setExternal($external)
    {
        $this->container['external'] = $external;

        return $this;
    }

    /**
     * Gets variables
     *
     * @return string|null
     */
    public function getVariables()
    {
        return $this->container['variables'];
    }

    /**
     * Sets variables
     *
     * @param string|null $variables variables
     *
     * @return $this
     */
    public function setVariables($variables)
    {
        $this->container['variables'] = $variables;

        return $this;
    }

    /**
     * Gets me
     *
     * @return string|null
     */
    public function getMe()
    {
        return $this->container['me'];
    }

    /**
     * Sets me
     *
     * @param string|null $me me
     *
     * @return $this
     */
    public function setMe($me)
    {
        $this->container['me'] = $me;

        return $this;
    }

    /**
     * Gets flags
     *
     * @return string|null
     */
    public function getFlags()
    {
        return $this->container['flags'];
    }

    /**
     * Sets flags
     *
     * @param string|null $flags flags
     *
     * @return $this
     */
    public function setFlags($flags)
    {
        $this->container['flags'] = $flags;

        return $this;
    }

    /**
     * Gets orgs
     *
     * @return string|null
     */
    public function getOrgs()
    {
        return $this->container['orgs'];
    }

    /**
     * Sets orgs
     *
     * @param string|null $orgs orgs
     *
     * @return $this
     */
    public function setOrgs($orgs)
    {
        $this->container['orgs'] = $orgs;

        return $this;
    }

    /**
     * Gets query
     *
     * @return \InfluxDB2\Model\RoutesQuery|null
     */
    public function getQuery()
    {
        return $this->container['query'];
    }

    /**
     * Sets query
     *
     * @param \InfluxDB2\Model\RoutesQuery|null $query query
     *
     * @return $this
     */
    public function setQuery($query)
    {
        $this->container['query'] = $query;

        return $this;
    }

    /**
     * Gets setup
     *
     * @return string|null
     */
    public function getSetup()
    {
        return $this->container['setup'];
    }

    /**
     * Sets setup
     *
     * @param string|null $setup setup
     *
     * @return $this
     */
    public function setSetup($setup)
    {
        $this->container['setup'] = $setup;

        return $this;
    }

    /**
     * Gets signin
     *
     * @return string|null
     */
    public function getSignin()
    {
        return $this->container['signin'];
    }

    /**
     * Sets signin
     *
     * @param string|null $signin signin
     *
     * @return $this
     */
    public function setSignin($signin)
    {
        $this->container['signin'] = $signin;

        return $this;
    }

    /**
     * Gets signout
     *
     * @return string|null
     */
    public function getSignout()
    {
        return $this->container['signout'];
    }

    /**
     * Sets signout
     *
     * @param string|null $signout signout
     *
     * @return $this
     */
    public function setSignout($signout)
    {
        $this->container['signout'] = $signout;

        return $this;
    }

    /**
     * Gets sources
     *
     * @return string|null
     */
    public function getSources()
    {
        return $this->container['sources'];
    }

    /**
     * Sets sources
     *
     * @param string|null $sources sources
     *
     * @return $this
     */
    public function setSources($sources)
    {
        $this->container['sources'] = $sources;

        return $this;
    }

    /**
     * Gets system
     *
     * @return \InfluxDB2\Model\RoutesSystem|null
     */
    public function getSystem()
    {
        return $this->container['system'];
    }

    /**
     * Sets system
     *
     * @param \InfluxDB2\Model\RoutesSystem|null $system system
     *
     * @return $this
     */
    public function setSystem($system)
    {
        $this->container['system'] = $system;

        return $this;
    }

    /**
     * Gets tasks
     *
     * @return string|null
     */
    public function getTasks()
    {
        return $this->container['tasks'];
    }

    /**
     * Sets tasks
     *
     * @param string|null $tasks tasks
     *
     * @return $this
     */
    public function setTasks($tasks)
    {
        $this->container['tasks'] = $tasks;

        return $this;
    }

    /**
     * Gets telegrafs
     *
     * @return string|null
     */
    public function getTelegrafs()
    {
        return $this->container['telegrafs'];
    }

    /**
     * Sets telegrafs
     *
     * @param string|null $telegrafs telegrafs
     *
     * @return $this
     */
    public function setTelegrafs($telegrafs)
    {
        $this->container['telegrafs'] = $telegrafs;

        return $this;
    }

    /**
     * Gets users
     *
     * @return string|null
     */
    public function getUsers()
    {
        return $this->container['users'];
    }

    /**
     * Sets users
     *
     * @param string|null $users users
     *
     * @return $this
     */
    public function setUsers($users)
    {
        $this->container['users'] = $users;

        return $this;
    }

    /**
     * Gets write
     *
     * @return string|null
     */
    public function getWrite()
    {
        return $this->container['write'];
    }

    /**
     * Sets write
     *
     * @param string|null $write write
     *
     * @return $this
     */
    public function setWrite($write)
    {
        $this->container['write'] = $write;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }
}


