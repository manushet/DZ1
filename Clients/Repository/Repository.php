<?php 
declare(strict_types = 1);

namespace Clients\Repository;

require_once 'Kernel/StartStopperInterface.php';
require_once 'Clients/Repository/MySQLConnection.php';

use Kernel\StartStopperInterface;
use Clients\Repository\MySQLConnection;

class Repository implements StartStopperInterface 
{
    private MySQLConnection $connection;

    public function __construct(public Config $config)
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