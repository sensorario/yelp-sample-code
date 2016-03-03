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
        $parameters
    ) {
        $httpClient = $this->getMockBuilder('Sensorario\Yelp\HttpClient')
            ->setMethods([$search])
            ->getMock();
        
        $service = new Sherlock(
            $httpClient
        );

        $service->find($search, $parameters);
    }

    public function searches()
    {
        return [
            ['search', ['term' => 'Milano Centrale', 'location' => 'Milano']],
            ['phone_search', ['phone' => '+394353543']],
            ['business', ['id' => 'milano-centrale-milano' ]],
        ];
    }
}
