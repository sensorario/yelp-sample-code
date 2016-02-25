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
            'category_filter' => 'pubs',
            'cc'              => 'IT',
            'lang'            => 'it',
            'limit'           => $this->properties['config']['yelp']['search']['limit'],
            'location'        => $this->properties['config']['yelp']['search']['location'],
            'term'            => 'ghost',
        ]);

        return SearchPath::withString(
            $searchPath = '/v2/search/' . "?" . $queryString
        );
    }
}
