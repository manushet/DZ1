<?php

declare(strict_types = 1);

namespace Clients\Worker;

use Clients\Utils\Worker;

class Worker1 extends Worker
{

    public function start(): void
    {
        // ...  
        $this->hasErrors = true;
        $this->error = "Error 1"; 
        echo "<br>Starting Worker1 ID {$this->id}...<br>";
    }

    public function shutdown(): void
    {
        // ... 
        echo "<br>Stopping Worker1 ID {$this->id}...<br>";
    }
}
