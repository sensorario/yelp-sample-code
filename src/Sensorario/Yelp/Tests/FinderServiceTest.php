<?php

namespace Sensorario\Yelp\Tests;

require __DIR__ . '/../../../../lib/OAuth.php';

use PHPUnit_Framework_TestCase;
use Sensorario\Yelp\Configuration;
use Sensorario\Yelp\FinderService;

final class FinderServiceTest extends PHPUnit_Framework_TestCase
{
    public function testGenericSearch()
    {
        $searchPathFactory = $this->getMockBuilder('Sensorario\Yelp\SearchPathFactory')
            ->setMethods(['search'])
            ->getMock();
        
        $yelpRequest = $this->getMockBuilder('Sensorario\Yelp\YelpRequest')
            ->setMethods(['search'])
            ->getMock();
        
        $searchService = $this->getMockBuilder('Sensorario\Yelp\SearchService')
            ->getMock();
        
        $service = new FinderService(
            new Configuration(),
            $searchPathFactory,
            $searchService,
            $yelpRequest
        );

        $service->genericSearch();
    }
}
