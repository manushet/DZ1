<?php 
declare(strict_types = 1);

namespace Clients\Repository;

use Kernel\StartStopperInterface;
use Clients\Repository\MySQLConnection;
use Clients\Repository\RepositoryConfig;

class Repository implements StartStopperInterface 
{
    private MySQLConnection $connection;

    public function __construct(public RepositoryConfig $config)
    {
        $this->connection = new MySQLConnection($config);
    }

    public function start(): void
    {
        $this->connection->connect();
    }

    public function shutdown(): void
    {
        $this->connection->disconnect();
    }
}