<?php
/**
 * Jaeger
 *
 * @copyright	Copyright (c) 2015-2016, mithra62
 * @link		http://jaeger-app.com
 * @version		1.0
 * @filesource 	./tests/RcfTest.php
 */
namespace JaegerApp\tests\Remote;

use JaegerApp\Remote\Rcf;

/**
 * Jaeger - Rcf Remote Object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Remote\Rcf object
 *
 * @package mithra62\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class RcfTest extends \PHPUnit_Framework_TestCase
{

    public function testServiceInstance()
    {
        $rcf = Rcf::getRemoteClient($this->getRcfCreds(), false);
        $this->assertInstanceOf('OpenCloud\ObjectStore\Service', $rcf);
    }

    public function testContainerInstance()
    {
        $rcf = Rcf::getRemoteClient($this->getRcfCreds());
        $this->assertInstanceOf('OpenCloud\ObjectStore\Resource\Container', $rcf);
    }

    /**
     * The Google Cloud Storage Test Credentials
     */
    protected function getRcfCreds()
    {
        return include 'data/rcfcreds.config.php';
    }
}