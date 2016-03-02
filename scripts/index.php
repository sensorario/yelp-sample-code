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

class Foo
{
    public static function bar(
        Request $request,
        array $parameters
    ) {
        $sherlock = new Sherlock(new HttpClient());
        $response = $sherlock->find('business', $parameters['id']);
        var_export($response);
    }

    public static function home(
        Request $request,
        array $parameters
    ) {
        echo "ancora da implementare";
    }

    public static function search(
        Request $request,
        array $parameters
    ) {
        $sherlock = new Sherlock(new HttpClient());
        $response = $sherlock->find('search');
        print_r($response);
    }

    public static function phone(
        Request $request,
        array $parameters
    ) {
        $sherlock = new Sherlock(new HttpClient());
        $response = $sherlock->find('phone_search');
        var_export($response);
    }

    public static function pageNotFound(
        Request $request,
        array $parameters
    ) {
        echo "La richiesta e' invalida";
        echo "<a href=\"/\">Vai in homepage</a>";
    }
}


$log = new Logger('parameters');
$log->pushHandler(new StreamHandler(__DIR__ . '/../app/logs/parameters.log', Logger::INFO));


$routes = new RouteCollection();


$routes->add('business', new Route('/business/{id}', array(
    'controller' => 'Foo',
    'action' => 'bar',
)));


$routes->add('home', new Route('/', array(
    'controller' => 'Foo',
    'action' => 'home',
)));


$routes->add('search', new Route('/search/{term}', array(
    'controller' => 'Foo',
    'action' => 'search',
)));


$routes->add('phone', new Route('/phone/{phone}', array(
    'controller' => 'Foo',
    'action' => 'phone',
)));


$context = new RequestContext();
$context->fromRequest($request = Request::createFromGlobals());


$matcher = new UrlMatcher($routes, $context);
try {
    $parameters = $matcher->match($context->getPathInfo());
    $log->addInfo(json_encode($parameters));
} catch (Exception $exception) {
    $parameters = [
        'controller' => 'Foo',
        'action' => 'pageNotFound'
    ];
}

$parameters['controller']::$parameters['action'](
    $request,
    $parameters
);
