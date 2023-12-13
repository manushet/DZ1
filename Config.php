<?php
declare(strict_types = 1);

require_once __DIR__.'/Clients/Repository/Config.php';
require_once __DIR__.'/Clients/Server/Config.php';

use Clients\Repository\Config as RepositoryConfig; 
use Clients\Server\Config as ServerConfig;

class Config {

    private const PATH = __DIR__.'/.env';

    public RepositoryConfig $repositoryConfig;

    public ServerConfig $serverConfig;

    public function __construct() 
    {
        $this->loadEnvironment();

        $this->repositoryConfig = new RepositoryConfig(
            getenv('DATABASE_HOST'),
            getenv('DATABASE_PORT'),
            getenv('DATABASE_NAME'),
            getenv('DATABASE_USER'),
            getenv('DATABASE_PASSWORD')
        );

        $this->serverConfig = new ServerConfig(
            getenv('SERVER_ADDR'),
            getenv('SERVER_HOST'),
            getenv('SERVER_PORT')
        );        
    }

    private function loadEnvironment(): void
    {
        $env = file_get_contents(self::PATH);

        if ($this->validateEnvFile()) {
            $lines = explode("\n",$env);
        
            foreach($lines as $line){
                preg_match("/([^#]+)\=(.*)/",$line,$matches);
                
                if (isset($matches[2])) {
                    putenv(trim($line));
                }
            } 
        }
    }
    

    private function validateEnvFile(): bool 
    {       
        if (!file_exists(self::PATH)) {
            throw new \InvalidArgumentException(sprintf('%s does not exist', self::PATH));
        }

        if (!is_readable(self::PATH)) {
            throw new \RuntimeException(sprintf('%s file is not readable', self::PATH));
        } 
 
        return true;
    }       
}