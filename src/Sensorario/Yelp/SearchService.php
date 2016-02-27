<?php

namespace Sensorario\Yelp;

use Sensorario\Yelp\Path;
use Sensorario\Yelp\YelpClient;
use Sensorario\Yelp\YelpResponse;

class SearchService
{
    public function search(
        YelpClient $yelpRequest,
        Path $path
    ) {
        return YelpResponse::fromHttpResponse(
            $yelpRequest->withPath($path->getPath())
        );
    }
}
