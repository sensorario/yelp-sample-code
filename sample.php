#!/usr/bin/php
<?php

require 'vendor/autoload.php';
require_once('lib/OAuth.php');

use Symfony\Component\Yaml\Yaml;
use Sensorario\Yelp\Request\YelpRequest;

$filename = 'app/config.yml';
$fileContent = file_get_contents($filename);
$config = Yaml::parse($fileContent);

$queryString = http_build_query([
    'category_filter' => 'pubs',
    'cc'              => 'IT',
    'lang'            => 'it',
    'limit'           => $config['yelp']['search']['limit'],
    'location'        => $config['yelp']['search']['location'],
    'term'            => 'ghost',
]);

$response = YelpRequest::withHostPathAndConfig(
    $apiHost    = $config['yelp']['api_host'],
    $searchPath = '/v2/search/' . "?" . $queryString,
    $config
);

$response = json_decode(
    $response
);

$businessId = $response->businesses[0]->id;

print sprintf(
    "%d businesses found, querying business info for the top result \"%s\"\n\n",         
    count($response->businesses),
    $businessId
);

$response = YelpRequest::withHostPathAndConfig(
    $config['yelp']['api_host'],
    '/v2/business/' . $businessId,
    $config
);

print sprintf(
    "Result for business \"%s\" found:\n",
    $businessId
);

print_r(
    json_decode(
        $response
    )
);
