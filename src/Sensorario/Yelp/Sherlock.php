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

    public function find($search, $id = null)
    {
        return $this->httpClient->requestPath(
            $this->buildSearch($search, $id)
        );
    }

    public function buildSearch($search, $id)
    {
        if ('business' === $search) {
            return '/v2/business/' . $id;
        }

        $queryString = http_build_query(
            $this->configuration['yelp'][$search]
        );

        return '/v2/' . $search . '/' . "?" . $queryString;
    }
}
