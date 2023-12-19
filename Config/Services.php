<?php

namespace Config;

use Symfony\Component\Yaml\Yaml;
use Service\Service1;
use Service\Service2;
use Service\Service3;
use Controller\IndexController;
use Controller\ResourseController;

class Services 
{
    public array $serviceMap;

    public function parseService(string $filename)
    {
        $serviceMap = Yaml::parseFile($filename);

        foreach ($serviceMap as $class => $params) {
            $this->serviceMap[$class] = $params["bind"];
        }
    }

    public function load($class) 
    {      
        $params = isset($this->serviceMap[$class]) ? $this->serviceMap[$class] : [];

        $args = [];
        
        if (count($params) > 0) {
            foreach ($params as $param) {
                if (stripos($param, "env:") === 0) {
                    $args[] = getenv(substr($param, 4));
                } else {
                    $args[] = $this->load($param);
                } 
            }
        }

        $class = str_ireplace("::class", "", $class);

        return new $class(...$args);
    }
}