<?php

namespace Sensorario\Yelp\Service;

use Sensorario\Yelp\Request\YelpRequest;
use Sensorario\Yelp\Response\YelpResponse;
use Sensorario\Yelp\Service\SearchPathFactory;
use Sensorario\Yelp\Service\SearchService;

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
