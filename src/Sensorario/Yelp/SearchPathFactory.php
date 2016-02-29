<?php

namespace Sensorario\Yelp;

use Sensorario\Yelp\SearchPath;

class SearchPathFactory
{
    public function __construct()
    {
        $this->configuration = (new Configuration())
            ->getConfig();
    }

    public function buildSearch($search)
    {
        if ('business' === $search) {
            $businessId = $this->configuration['yelp']['business']['id'];

            return '/v2/business/' . $businessId;
        }

        $queryString = http_build_query(
            $this->configuration['yelp'][$search]
        );

        return '/v2/' . $search . '/' . "?" . $queryString;
    }
}
