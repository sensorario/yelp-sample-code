<?php

namespace Sensorario\Yelp;

use Sensorario\Yelp\SearchPath;

class SearchPathFactory
{
    public function buildGenericSearch()
    {
        $configuration = (new Configuration())
            ->getConfig();

        $queryString = http_build_query(
            $configuration['yelp']['search']
        );

        return '/v2/search/' . "?" . $queryString;
    }

    public function buildBusinessSearch($businessId)
    {
        return '/v2/business/' . $businessId;
    }
}
