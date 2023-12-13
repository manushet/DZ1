<?php 
declare(strict_types = 1);

namespace Clients\Server;

require_once 'Kernel/StartStopperInterface.php';
require_once 'Clients/Server/ServerConnection.php';

use \Clients\Server\Config;
use \Kernel\StartStopperInterface;
use Clients\Server\ServerConnection;

class Server implements StartStopperInterface 
{
    private ServerConnection $connection;

    public function __construct(public Config $config) {
        $this->connection = new ServerConnection($config);
    }
    
    public function start(): void {
        $this->connection->connect();   
    }

    public function shutdown(): void {
        $this->connection->disconnect();    
    }      
}