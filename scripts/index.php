<?php

date_default_timezone_set('Europe/Rome');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../lib/OAuth.php';

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Sensorario\Yelp\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;


$log = new Logger('parameters');
$log->pushHandler(new StreamHandler(__DIR__ . '/../app/logs/parameters.log', Logger::INFO));


$routes = new RouteCollection();


$routes->add('business', new Route('/business/{id}', array(
    'controller' => 'Sensorario\\Yelp\\Controller',
    'action' => 'bar',
)));


$routes->add('home', new Route('/', array(
    'controller' => 'Sensorario\\Yelp\\Controller',
    'action' => 'home',
)));


$routes->add('search', new Route('/search/{term}/in/{location}', array(
    'controller' => 'Sensorario\\Yelp\\Controller',
    'action' => 'search',
)));


$routes->add('phone', new Route('/phone/{phone}', array(
    'controller' => 'Sensorario\\Yelp\\Controller',
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
        'controller' => 'Controller',
        'action' => 'pageNotFound'
    ];
}

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../views');
$twig = new Twig_Environment($loader, []);

$controller = new $parameters['controller'](
    $twig
);

$view = $controller->$parameters['action'](
    $request,
    $parameters
);

echo $view;
