<?php
/**
 * Jaeger
 *
 * @copyright	Copyright (c) 2015-2016, mithra62
 * @link		http://jaeger-app.com
 * @version		1.0
 * @filesource 	./Remote/Rcf.php
 */
namespace JaegerApp\Remote;


use OpenCloud\Rackspace;
use League\Flysystem\Rackspace\RackspaceAdapter as Adapter;

/**
 * Jaeger - Rackspace Cloud Files Transfer Abstraction
 *
 * Simple intermediary between Rackspace Cloud Files, Flysystem and mithra62
 *
 * @package Remote
 * @author Eric Lamb <eric@mithra62.com>
 */
class Rcf extends Adapter
{

    /**
     * Returns the remote transport client
     * 
     * @param array $params            
     * @param string $include_container            
     * @return \OpenCloud\ObjectStore\Resource\Container|\OpenCloud\ObjectStore\Service
     */
    public static function getRemoteClient(array $params, $include_container = true)
    {
        $url = (isset($params['rcf_location']) && strtolower($params['rcf_location']) == 'uk' ? Rackspace::UK_IDENTITY_ENDPOINT : Rackspace::US_IDENTITY_ENDPOINT);
        $client = new Rackspace($url, [
            'username' => $params['rcf_username'],
            'apiKey' => $params['rcf_api']
        ]);
        
        $client->authenticate();
        $store = $client->objectStoreService('cloudFiles');
        if ($include_container) {
            return $store->getContainer($params['rcf_container']);
        }
        
        return $store;
    }
}