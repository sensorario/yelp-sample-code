<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../lib/OAuth.php';

use Sensorario\Yelp\Sherlock;
use Sensorario\Yelp\SearchPathFactory;
use Sensorario\Yelp\HttpClient;

$sherlock = new Sherlock(
    new SearchPathFactory(),
    new HttpClient()
);

echo "\n";
$response = $sherlock->find('search');
print_r($response);

echo "\n";
$response = $sherlock->find('business');
var_export($response);

echo "\n";
$response = $sherlock->find('phone_search');
var_export($response);
