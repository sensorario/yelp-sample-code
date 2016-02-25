<?php

namespace Sensorario\Yelp\Service;

use Sensorario\Yelp\Objects\SearchPath;

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
        $queryString = http_build_query([
            'category_filter' => $this->properties['config']['yelp']['search']['category_filter'],
            'cc'              => $this->properties['config']['yelp']['search']['cc'],
            'lang'            => $this->properties['config']['yelp']['search']['lang'],
            'limit'           => $this->properties['config']['yelp']['search']['limit'],
            'location'        => $this->properties['config']['yelp']['search']['location'],
            'term'            => $this->properties['config']['yelp']['search']['term'],
        ]);

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
