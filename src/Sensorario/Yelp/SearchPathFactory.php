<?php

namespace Sensorario\Yelp;

use Sensorario\Yelp\SearchPath;

final class SearchPathFactory
{
    private $properties;

    private function __construct(array $properties)
    {
        $this->properties = $properties;
    }

    public static function fromConfiguration(array $config)
    {
        return new self([
            'config' => $config
        ]);
    }

    public function buildGenericSearch()
    {
        $queryString = http_build_query(
            $this->properties['config']['yelp']['search']
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
