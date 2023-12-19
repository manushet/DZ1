<?php

namespace Config;

use Symfony\Component\Yaml\Yaml;

class Routes 
{
    public array $routeMap;

    public function parseRoute(string $filename)
    {
        $routeMap = Yaml::parseFile($filename);

        foreach ($routeMap as $route => $params) {
            $this->routeMap[$route] = [
                "class" => $params["controller"],
                "method" => $params["method"],
                "action" => $params["action"],
            ];
        }

        //var_dump($this->routeMap);
    }
}