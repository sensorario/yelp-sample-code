#!/usr/bin/php
<?php

require 'vendor/autoload.php';
require_once('lib/OAuth.php');

use Symfony\Component\Yaml\Yaml;
use Sensorario\Yelp\Request\YelpRequest;
use Sensorario\Yelp\Response\YelpResponse;
use Sensorario\Yelp\Service\SearchService;

$filename = 'app/config.yml';
$fileContent = file_get_contents($filename);
$config = Yaml::parse($fileContent);

$yelpRequest = YelpRequest::fromConfiguration($config);
$searchService = SearchService::fromConfiguration($config);

$yelpResponse = $searchService->genericSearch($yelpRequest);
print sprintf(
    "%d businesses found, querying business info for the top result \"%s\"\n\n",         
    $businessNumber = $yelpResponse->numberOfBusinesses(),
    $businessId = $yelpResponse->currentBusinessId()
);

// ask for business informations
$businessItem = '/v2/business/' . $businessId;
$response = $yelpRequest->withSearchPath($businessItem);
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
