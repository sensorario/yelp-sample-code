<?php

namespace Sensorario\Yelp;

use Sensorario\Yelp\YelpRequest;
use Sensorario\Yelp\YelpResponse;
use Sensorario\Yelp\SearchPathFactory;
use Sensorario\Yelp\SearchService;

final class Scerlock
{
    public function __construct(
        Configuration $config,
        SearchPathFactory $searchPathFactory,
        SearchService $searchService,
        YelpRequest $yelpRequest
    ) {
        $this->searchService = $searchService;
        $this->searchPathFactory = $searchPathFactory
            ->withConfiguration(
                $config->getConfig()
            );
        $this->yelpRequest = $yelpRequest
            ->withConfiguration(
                $config->getConfig()
            );
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
