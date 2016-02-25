<?php

namespace Sensorario\Yelp\Interfaces;

interface Path
{
    public static function withString($string);

    public function getPath();
}
