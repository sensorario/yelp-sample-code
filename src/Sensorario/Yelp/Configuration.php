<?php

namespace Sensorario\Yelp;

use Symfony\Component\Yaml\Yaml;

final class Configuration
{
    public function getConfig()
    {
        return Yaml::parse(
            file_get_contents(
                __DIR__ . '/../../../app/config.yml'
            )
        );
    }
}
