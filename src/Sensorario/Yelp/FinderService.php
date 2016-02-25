<?php

namespace Sensorario\Yelp;

use Sensorario\Yelp\YelpRequest;
use Sensorario\Yelp\YelpResponse;
use Sensorario\Yelp\SearchPathFactory;
use Sensorario\Yelp\SearchService;

final class FinderService
{
    private $collaborators = [
        'yelpRequest',
        'searchService',
        'searchPathFactory',
    ];

    public function __construct($config)
    {
        foreach ($this->collaborators as $collaborator) {
            $collaboratorName = 'Sensorario\\Yelp\\' . ucfirst($collaborator);
            $this->$collaborator = $collaboratorName::fromConfiguration($config);
        }
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
