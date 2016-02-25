<?php

namespace Sensorario\Yelp\Response;

final class YelpResponse
{
    private $properties;

    private function __construct(array $params)
    {
        $this->properties = $params;
    }

    public static function fromHttpResponse($response)
    {
        return new self([
            'jsonResponse' => json_decode($response),
        ]);
    }

    public function currentBusinessId()
    {
        return $this
            ->properties['jsonResponse']
            ->businesses[0]
            ->id;
    }

    public function numberOfBusinesses()
    {
        $businesses = $this
            ->properties['jsonResponse']
            ->businesses;

        return count($businesses);
    }
}
