#!/usr/bin/php
<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../lib/OAuth.php';

use Sensorario\Yelp\Request\YelpRequest;
use Sensorario\Yelp\Response\YelpResponse;
use Sensorario\Yelp\Service\SearchPathFactory;
use Sensorario\Yelp\Service\SearchService;
use Symfony\Component\Yaml\Yaml;

$filename = 'app/config.yml';
$fileContent = file_get_contents($filename);
$config = Yaml::parse($fileContent);

$yelpRequest = YelpRequest::fromConfiguration($config);
$searchService = SearchService::fromConfiguration($config);
$searchFactory = SearchPathFactory::fromConfiguration($config);

$yelpResponse = $searchService->search(
    $yelpRequest,
    $searchFactory->buildGenericSearch()
);

print sprintf(
    "%d businesses found, querying business info for the top result \"%s\"\n\n",         
    $businessNumber = count($yelpResponse->getContent()->businesses),
    $businessId = $yelpResponse->getContent()->businesses[0]->id
);

$yelpResponse = $searchService->search(
    $yelpRequest,
    $searchFactory->buildBusinessSearch(
        $businessId
    )
);

print sprintf(
    "Result for business \"%s\" found:\n",
    $businessId
);

// view response
print_r(
    $yelpResponse->getContent()
);
