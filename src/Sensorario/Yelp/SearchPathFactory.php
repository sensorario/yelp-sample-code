<?php

namespace Sensorario\Yelp;

use Sensorario\Yelp\SearchPath;

class SearchPathFactory
{
    private $configuration;

    public function withConfiguration(array $configuration)
    {
        $this->configuration = $configuration;

        return $this;
    }

    public function buildGenericSearch()
    {
        $queryString = http_build_query(
            $this->configuration['yelp']['search']
        );

        return $this->buildSearch(
            $searchPath = '/v2/search/' . "?" . $queryString
        );
    }

    public function buildBusinessSearch($businessId)
    {
        return $this->buildSearch(
            $businessItem = '/v2/business/' . $businessId
        );
    }

    public function buildSearch($path)
    {
        return SearchPath::withString($path);
    }
}
