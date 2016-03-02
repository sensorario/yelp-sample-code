<?php

date_default_timezone_set('Europe/Rome');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../lib/OAuth.php';

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Formatter\JsonFormatter;
use Sensorario\Yelp\HttpClient;
use Sensorario\Yelp\Sherlock;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$log = new Logger('parameters');
$log->pushHandler(new StreamHandler(__DIR__ . '/../app/logs/parameters.log', Logger::INFO));

$routes = new RouteCollection();
$routes->add('business', new Route('/business/{id}', array(
    'controller' => 'foo',
    'action' => 'ciao'
)));

$context = new RequestContext();
$context->fromRequest(Request::createFromGlobals());

$matcher = new UrlMatcher($routes, $context);
$parameters = $matcher->match($context->getPathInfo());

$log->addInfo(json_encode($parameters));

$sherlock = new Sherlock(new HttpClient());
$response = $sherlock->find('business', $parameters['id']);
print_r($response);

// echo "\n";
// $response = $sherlock->find('search');
// print_r($response);
// 
// 
// echo "\n";
// $response = $sherlock->find('phone_search');
// var_export($response);
