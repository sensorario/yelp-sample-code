<?php

namespace Sensorario\Yelp;

use Sensorario\Yelp\YelpRequest;
use Sensorario\Yelp\YelpResponse;
use Sensorario\Yelp\SearchPathFactory;
use Sensorario\Yelp\SearchService;

final class Sherlock
{
    public function __construct(
        SearchPathFactory $searchPathFactory,
        SearchService $searchService,
        YelpRequest $yelpRequest
    ) {
        $this->searchService = $searchService;
        $this->searchPathFactory = $searchPathFactory;
        $this->yelpRequest = $yelpRequest;
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
        return $this->searchService->search(
            $this->yelpRequest,
            $search
        );
    }
}
