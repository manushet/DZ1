<?php

declare(strict_types = 1);

namespace Clients\Repository;

use \PDO;
use \Exception;
use Clients\Utils\Connection;
use Clients\Utils\Exception\ConnectionException;

class MySQLConnection extends Connection
{  
    public function connect(): void
    {       
        try {
            /*$dsn = "mysql:host={$this->config->host};port={$this->config->port};dbname={$this->config->database}";
            $pdo = new PDO($dsn, $this->config->user, $this->config->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $this->connection = $pdo;*/
    
            echo "<br>Connected to the MySQL Server successfully<br>";
        }
        catch (Exception $e) {
            throw new ConnectionException(sprintf('Unable to connect to the MySQL Server: %s', $e->getMessage())); 
        }    

    }

    public function disconnect(): void
    {
        $this->connection = null;

        echo "<br>Disconnected from the MySQL Server successfully<br>";
    }
}
