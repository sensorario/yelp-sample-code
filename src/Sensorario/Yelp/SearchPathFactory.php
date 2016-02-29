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

    public function buildPhoneSearch()
    {
        $queryString = http_build_query(
            $this->configuration['yelp']['phone_search']
        );

        return '/v2/phone_search/' . "?" . $queryString;
    }
    
    public function buildGenericSearch()
    {
        $queryString = http_build_query(
            $this->configuration['yelp']['search']
        );

        return '/v2/search/' . "?" . $queryString;
    }

    public function buildBusinessSearch()
    {
        $businessId = $this->configuration['yelp']['business']['id'];

        return '/v2/business/' . $businessId;
    }
}
