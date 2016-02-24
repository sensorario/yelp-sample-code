#!/usr/bin/php
<?php

require 'vendor/autoload.php';
require_once('lib/OAuth.php');

use Symfony\Component\Yaml\Yaml;
use Sensorario\Yelp\Request\YelpRequest;

$filename = 'app/config.yml';
$fileContent = file_get_contents($filename);
$config = Yaml::parse($fileContent);

$yelpRequest = YelpRequest::fromConfiguration($config);

// search some stuffs ...
$queryString = http_build_query([
    'category_filter' => 'pubs',
    'cc'              => 'IT',
    'lang'            => 'it',
    'limit'           => $config['yelp']['search']['limit'],
    'location'        => $config['yelp']['search']['location'],
    'term'            => 'ghost',
]);
$response = $yelpRequest->withSearchPath($searchPath = '/v2/search/' . "?" . $queryString);
$jsonResponse = json_decode($response);
$businessId = $jsonResponse->businesses[0]->id;
print sprintf(
    "%d businesses found, querying business info for the top result \"%s\"\n\n",         
    count($jsonResponse->businesses),
    $businessId
);

// ask for business informations
$response = $yelpRequest->withSearchPath('/v2/business/' . $businessId);
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
