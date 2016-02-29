<?php

namespace Sensorario\Yelp;

use Sensorario\Yelp\HttpClient;
use Sensorario\Yelp\YelpResponse;
use Sensorario\Yelp\SearchPathFactory;

final class Sherlock
{
    public function __construct(
        SearchPathFactory $searchPathFactory,
        HttpClient $httpClient
    ) {
        $this->searchPathFactory = $searchPathFactory;
        $this->httpClient = $httpClient;
    }

    public function find($search)
    {
        return $this->httpClient->requestPath(
            $this->searchPathFactory->buildSearch($search)
        );
    }
}
