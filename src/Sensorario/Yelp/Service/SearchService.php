<?php

namespace Sensorario\Yelp\Service;

use Sensorario\Yelp\Interfaces\Path;
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

    public function search(
        YelpRequest $yelpRequest,
        Path $path
    ) {
        return YelpResponse::fromHttpResponse(
            $yelpRequest->withPath($path->getPath())
        );
    }
}
