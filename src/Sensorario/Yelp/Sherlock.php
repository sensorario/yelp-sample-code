<?php

namespace Sensorario\Yelp;

use Sensorario\Yelp\YelpClient;
use Sensorario\Yelp\YelpResponse;
use Sensorario\Yelp\SearchPathFactory;

final class Sherlock
{
    public function __construct(
        SearchPathFactory $searchPathFactory,
        YelpClient $yelpClient
    ) {
        $this->searchPathFactory = $searchPathFactory;
        $this->yelpClient = $yelpClient;
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

    private function search($search)
    {
        return YelpResponse::fromHttpResponse(
            $this->yelpClient->requestPath(
                $search->getPath()
            )
        );
    }
}
