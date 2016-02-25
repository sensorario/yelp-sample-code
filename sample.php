#!/usr/bin/php
<?php

require 'vendor/autoload.php';
require_once('lib/OAuth.php');

use Sensorario\Yelp\Interfaces\Path;
use Sensorario\Yelp\Objects\SearchPath;
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
$searchPath = SearchPathFactory::fromConfiguration($config);

$yelpResponse = $searchService->search(
    $yelpRequest,
    $searchPath->buildGenericSearch()
);

print sprintf(
    "%d businesses found, querying business info for the top result \"%s\"\n\n",         
    $businessNumber = $yelpResponse->numberOfBusinesses(),
    $businessId = $yelpResponse->currentBusinessId()
);

// ask for business informations
$businessItem = '/v2/business/' . $businessId;
$response = $yelpRequest->withPath($businessItem);
print sprintf(
    "Result for business \"%s\" found:\n",
    $businessId
);

// view response
print_r(
    json_decode(
        $response
    )
);
