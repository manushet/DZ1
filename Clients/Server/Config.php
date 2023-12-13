<?php 
declare(strict_types = 1);

namespace Clients\Server;

require_once 'Clients/Utils/ServiceConfigInterface.php';

use \Clients\Utils\ServiceConfigInterface;

class Config  implements ServiceConfigInterface 
{
    public function __construct(
        public string $addr, 
        public string $host, 
        public string $port)
    {

    }

    public function validateConfig(): void 
    {       
        if (!$this->addr) {
            throw new \InvalidArgumentException(sprintf('Environment variable SERVER_ADDR is missing'));
        }
        if (!$this->host) {
            throw new \InvalidArgumentException(sprintf('Environment variable SERVER_HOST is missing'));
        }    
        if (!$this->port) {
            throw new \InvalidArgumentException(sprintf('Environment variable SERVER_PORT is missing'));
        }         
    } 
}