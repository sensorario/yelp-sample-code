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

    public function genericSearch()
    {
        return $this->search(
            $this->searchPathFactory->buildGenericSearch()
        );
    }

    public function businessSearch($businessId)
    {
        return $this->search(
            $this->searchPathFactory->buildBusinessSearch(
                $businessId
            )
        );
    }

    private function search($path)
    {
        return $this->httpClient->requestPath($path);
    }
}
