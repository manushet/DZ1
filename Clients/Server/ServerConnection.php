<?php

declare(strict_types = 1);

namespace Clients\Server;

require_once 'Clients/Utils/Exception/ConnectionException.php';
require_once 'Clients/Utils/Connection.php';

use Exception;
use Clients\Utils\Exception\ConnectionException;
use \Clients\Utils\Connection;

class ServerConnection extends Connection
{
    public function connect(): void
    {       
        try {
            $this->connection = "Connection to {$this->config->host}:{$this->config->port}";
            echo "<br>Connected to the server successfully<br>";
        }
        catch (Exception $e) {
            throw new ConnectionException(sprintf('Unable to connect to the server: %s', $e->getMessage())); 
        }  
        
    }

    public function disconnect(): void
    {
        $this->connection = null;

        echo "<br>Disconnected from the server successfully<br>";
    }
}
