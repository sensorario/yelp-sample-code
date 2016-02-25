<?php

namespace Sensorario\Yelp\Objects;

use Sensorario\Yelp\Interfaces\Path;

final class SearchPath implements Path
{
    private $path;

    private function __construct($path)
    {
        $this->path = $path;
    }

    public static function withString($string)
    {
        return new self(
            $string
        );
    }

    public function getPath()
    {
        return $this->path;
    }
}
