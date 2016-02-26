<?php

namespace Sensorario\Yelp\Tests;

require __DIR__ . '/../../../../lib/OAuth.php';

use PHPUnit_Framework_TestCase;
use Sensorario\Yelp\Configuration;
use Sensorario\Yelp\FinderService;
use Sensorario\Yelp\SearchPathFactory;

final class FinderServiceTest extends PHPUnit_Framework_TestCase
{
    public function testGenericSearch()
    {
        $service = new FinderService(
            new Configuration(),
            new SearchPathFactory()
            /** @todo add all collaborators */
        );

        $service->genericSearch();
    }
}
