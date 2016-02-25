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
        return $this->searchService->search(
            $this->yelpRequest,
            $this->searchFactory->buildGenericSearch()
        );
    }

    public function businessSearch($businessId)
    {
        return $this->searchService->search(
            $this->yelpRequest,
            $this->searchFactory->buildBusinessSearch(
                $businessId
            )
        );
    }
}
