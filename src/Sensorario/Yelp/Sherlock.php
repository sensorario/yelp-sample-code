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

    public function find($search)
    {
        return $this->httpClient->requestPath(
            $this->buildSearch($search)
        );
    }

    public function buildSearch($search)
    {
        if ('business' === $search) {
            $businessId = $this->configuration['yelp']['business']['id'];

            return '/v2/business/' . $businessId;
        }

        $queryString = http_build_query(
            $this->configuration['yelp'][$search]
        );

        return '/v2/' . $search . '/' . "?" . $queryString;
    }
}
