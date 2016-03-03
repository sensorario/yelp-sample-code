<?php

namespace Sensorario\Yelp;

use Sensorario\Yelp\HttpClient;

final class Sherlock
{
    public function __construct(
        HttpClient $httpClient
    ) {
        $this->httpClient = $httpClient;
        $this->configuration = (new Configuration())
            ->getConfig();
    }

    public function find($search, array $parameters)
    {
        return $this->httpClient->requestPath(
            $this->buildSearch(
                $search,
                $parameters
            )
        );
    }

    public function buildSearch($search, $parameters)
    {
        if ('business' === $search) {
            return '/v2/business/' . $parameters['id'];
        }

        if ('search' === $search) {
            $queryString = http_build_query([
                'term'     => $parameters['term'],
                'location' => $parameters['location'],
            ]);

            return '/v2/' . $search . '/' . "?" . $queryString;
        }

        if ('phone_search' === $search) {
            $queryString = http_build_query([
                'phone' => $parameters['phone'],
            ]);

            return '/v2/' . $search . '/' . "?" . $queryString;
        }

        throw new RuntimeException(
            ''
        );
    }
}
