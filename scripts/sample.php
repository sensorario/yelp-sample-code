#!/usr/bin/php
<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../lib/OAuth.php';

use Sensorario\Yelp\Sherlock;
use Sensorario\Yelp\SearchPathFactory;
use Sensorario\Yelp\HttpClient;

$finder = new Sherlock(
    new SearchPathFactory(),
    new HttpClient()
);

$response = json_decode($finder->genericSearch());

print sprintf(
    "%d businesses found, querying business info for the top result \"%s\"\n\n",         
    $businessNumber = count($response->businesses),
    $businessId = $response->businesses[0]->id
);

print sprintf(
    "Result for business \"%s\" found:\n",
    $businessId
);

$response = json_decode($finder->businessSearch($businessId));

print sprintf(
    print_r(
        $response,
        true
    )
);
