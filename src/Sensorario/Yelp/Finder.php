<?php

namespace Sensorario\Yelp;

use Sensorario\Yelp\YelpRequest;
use Sensorario\Yelp\YelpResponse;
use Sensorario\Yelp\SearchPathFactory;
use Sensorario\Yelp\SearchService;

final class Finder
{
    public function __construct($config)
    {
        $this->yelpRequest = YelpRequest::fromConfiguration($config);
        $this->searchService = SearchService::fromConfiguration($config);
        $this->searchFactory = SearchPathFactory::fromConfiguration($config);
    }

    public function genericSearch()
    {
        return $this->search(
            $this->searchFactory->buildGenericSearch()
        );
    }

    public function businessSearch($businessId)
    {
        return $this->search(
            $this->searchFactory->buildBusinessSearch(
                $businessId
            )
        );
    }

    private function search($search)
    {
        return $this->searchService->search(
            $this->yelpRequest,
            $search
        );
    }
}
