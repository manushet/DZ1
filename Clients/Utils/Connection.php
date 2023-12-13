<?php

declare(strict_types = 1);

namespace Clients\Utils;

abstract class Connection 
{
    protected $config;
    protected $connection;

    public function __construct(ServiceConfigInterface $config) 
    {
        $this->config = $config;
    }

    abstract public function connect(): void;

    abstract public function disconnect(): void;
}