<?php

namespace Sensorario\Yelp\Tests;

require __DIR__ . '/../../../../lib/OAuth.php';

use PHPUnit_Framework_TestCase;
use Sensorario\Yelp\Configuration;
use Sensorario\Yelp\Sherlock;

final class SherlockTest extends PHPUnit_Framework_TestCase
{
    /** @dataProvider searches */
    public function testGenericSearch($search)
    {
        $httpClient = $this->getMockBuilder('Sensorario\Yelp\HttpClient')
            ->setMethods([$search])
            ->getMock();
        
        $service = new Sherlock(
            $httpClient
        );

        $service->find($search);
    }

    public function searches()
    {
        return [
            ['search'],
            ['phone_search'],
            ['business'],
        ];
    }
}
