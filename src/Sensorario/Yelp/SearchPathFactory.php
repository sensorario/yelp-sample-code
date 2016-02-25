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
        $config = $this->properties['config']['yelp']['search'];

        $queryString = http_build_query($config);

        return SearchPath::withString(
            $searchPath = '/v2/search/' . "?" . $queryString
        );
    }

    public function buildBusinessSearch($businessId)
    {
        return SearchPath::withString(
            $businessItem = '/v2/business/' . $businessId
        );
    }
}
