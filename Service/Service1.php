<?php

namespace Service;

use Service\Service3;

class Service1
{   
    public function __construct(public Service3 $service3, public $arg3)
    {       

    }
}