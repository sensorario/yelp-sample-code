#!/usr/bin/php
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
$response = $sherlock->genericSearch();
var_export($response);

echo "\n";
$response = $sherlock->businessSearch();
var_export($response);

echo "\n";
$response = $sherlock->phoneSearch();
var_export($response);
