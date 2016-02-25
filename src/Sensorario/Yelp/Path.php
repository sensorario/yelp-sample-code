<?php

namespace Sensorario\Yelp;

interface Path
{
    public static function withString($string);

    public function getPath();
}
