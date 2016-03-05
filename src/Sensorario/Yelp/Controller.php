<?php

namespace Sensorario\Yelp;

use Sensorario\Yelp\HttpClient;
use Sensorario\Yelp\Sherlock;
use Symfony\Component\HttpFoundation\Request;

class Controller
{
    private $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function bar(
        Request $request,
        array $parameters
    ) {
        $sherlock = new Sherlock(new HttpClient());

        $response = $sherlock->find(
            'business',
            $parameters
        );

        return $this->twig->render(
            'viewer.html', [
                'response' => $response
            ]
        );
    }

    public function home(
        Request $request,
        array $parameters
    ) {
        return $this->twig->render(
            'home.html'
        );
    }

    public function search(
        Request $request,
        array $parameters
    ) {
        $sherlock = new Sherlock(new HttpClient());

        $response = $sherlock->find(
            'search',
            $parameters
        );

        return $this->twig->render(
            'viewer.html', [
                'response' => $response
            ]
        );
    }

    public function phone(
        Request $request,
        array $parameters
    ) {
        $sherlock = new Sherlock(new HttpClient());
        $response = $sherlock->find(
            'phone_search',
            $parameters
        );

        return $this->twig->render(
            'viewer.html', [
                'response' => $response
            ]
        );
    }

    public function pageNotFound(
        Request $request,
        array $parameters
    ) {
        return $this->twig->render(
            'pageNotFound.html', []
        );
    }
}
