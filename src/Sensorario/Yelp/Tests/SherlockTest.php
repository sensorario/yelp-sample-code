<?php

namespace Sensorario\Yelp\Tests;

require __DIR__ . '/../../../../lib/OAuth.php';

use PHPUnit_Framework_TestCase;
use Sensorario\Yelp\Configuration;
use Sensorario\Yelp\Sherlock;

final class SherlockTest extends PHPUnit_Framework_TestCase
{
    /** @dataProvider searches */
    public function testGenericSearch(
        $search,
        $id
    ) {
        $httpClient = $this->getMockBuilder('Sensorario\Yelp\HttpClient')
            ->setMethods([$search])
            ->getMock();
        
        $service = new Sherlock(
            $httpClient
        );

        $service->find($search, $id);
    }

    public function searches()
    {
        return [
            ['search', null],
            ['phone_search', null],
            ['business', 'milano-centrale-milano'],
        ];
    }
}
