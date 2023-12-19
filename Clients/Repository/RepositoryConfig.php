<?php 
declare(strict_types = 1);

namespace Clients\Repository;

use Clients\Utils\ServiceConfigInterface;

class RepositoryConfig implements ServiceConfigInterface 
{
    public function __construct(
        public string $host, 
        public string $port,
        public string $database,
        public string $user, 
        public string $password) 
    {
        $this->validateConfig();
    }

    public function validateConfig(): void 
    {       
        if (!$this->host) {
            throw new \InvalidArgumentException(sprintf('Environment variable DATABASE_HOST is missing'));
        }
        if (!$this->port) {
            throw new \InvalidArgumentException(sprintf('Environment variable DATABASE_PORT is missing'));
        }    
        if (!$this->database) {
            throw new \InvalidArgumentException(sprintf('Environment variable DATABASE_NAME is missing'));
        }  
        if (!$this->user) {
            throw new \InvalidArgumentException(sprintf('Environment variable DATABASE_USER is missing'));
        }                                   
        if (!$this->password) {
            throw new \InvalidArgumentException(sprintf('Environment variable DATABASE_PASSWORD is missing'));
        }         
    }          
}