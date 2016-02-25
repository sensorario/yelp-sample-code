<?php

namespace Sensorario\Yelp\Service;

use Sensorario\Yelp\Request\YelpRequest;
use Sensorario\Yelp\Response\YelpResponse;

final class SearchService
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

    public function genericSearch(YelpRequest $yelpRequest)
    {
        $queryString = http_build_query([
            'category_filter' => 'pubs',
            'cc'              => 'IT',
            'lang'            => 'it',
            'limit'           => $this->properties['config']['yelp']['search']['limit'],
            'location'        => $this->properties['config']['yelp']['search']['location'],
            'term'            => 'ghost',
        ]);

        $searchPath = $searchPath = '/v2/search/' . "?" . $queryString;

        return YelpResponse::fromHttpResponse(
            $yelpRequest->withSearchPath($searchPath)
        );
    }
}
