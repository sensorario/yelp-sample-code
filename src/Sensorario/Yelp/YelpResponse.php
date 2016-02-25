<?php

namespace Sensorario\Yelp;

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

    public function getContent()
    {
        return $this
            ->properties['jsonResponse'];
    }
}
