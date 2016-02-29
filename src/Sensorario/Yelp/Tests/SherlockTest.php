<?php

namespace Sensorario\Yelp\Tests;

require __DIR__ . '/../../../../lib/OAuth.php';

use PHPUnit_Framework_TestCase;
use Sensorario\Yelp\Configuration;
use Sensorario\Yelp\Sherlock;

final class SherlockTest extends PHPUnit_Framework_TestCase
{
    public function testGenericSearch()
    {
        $searchPathFactory = $this->getMockBuilder('Sensorario\Yelp\SearchPathFactory')
            ->setMethods(['search'])
            ->getMock();
        
        $httpClient = $this->getMockBuilder('Sensorario\Yelp\HttpClient')
            ->setMethods(['search'])
            ->getMock();
        
        $service = new Sherlock(
            $searchPathFactory,
            $httpClient
        );

        $service->find('search');
    }
}
