<?php

namespace Sensorario\Yelp;

use Sensorario\Yelp\Path;
use Sensorario\Yelp\YelpRequest;
use Sensorario\Yelp\YelpResponse;

class SearchService
{
    public function search(
        YelpRequest $yelpRequest,
        Path $path
    ) {
        return YelpResponse::fromHttpResponse(
            $yelpRequest->withPath($path->getPath())
        );
    }
}
