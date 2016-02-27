#!/usr/bin/php
<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../lib/OAuth.php';

use Sensorario\Yelp\Configuration;
use Sensorario\Yelp\FinderService;
use Sensorario\Yelp\SearchPathFactory;
use Sensorario\Yelp\SearchService;
use Sensorario\Yelp\YelpRequest;

$finder = new FinderService(
    new Configuration(),
    new SearchPathFactory(),
    new SearchService(),
    new YelpRequest()
);

$yelpResponse = $finder->genericSearch();

print sprintf(
    "%d businesses found, querying business info for the top result \"%s\"\n\n",         
    $businessNumber = count($yelpResponse->getContent()->businesses),
    $businessId = $yelpResponse->getContent()->businesses[0]->id
);

print sprintf(
    "Result for business \"%s\" found:\n",
    $businessId
);

$yelpResponse = $finder->businessSearch($businessId);

print sprintf(
    print_r(
        $yelpResponse->getContent(),
        true
    )
);
