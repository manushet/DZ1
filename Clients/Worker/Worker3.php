<?php

declare(strict_types = 1);

namespace Clients\Worker;

use Clients\Utils\Worker;

class Worker3 extends Worker
{

    public function start(): void
    {
        // ...  
        //$this->hasErrors = true;
        //$this->error = "Error 3"; 
        echo "<br>Starting Worker3 ID {$this->id}...<br>";
    }

    public function shutdown(): void
    {
        // ... 
        echo "<br>Stopping Worker3 ID {$this->id}...<br>";
    }
}
