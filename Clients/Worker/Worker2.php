<?php

declare(strict_types = 1);

namespace Clients\Worker;

use Clients\Utils\Worker;

class Worker2 extends Worker
{

    public function start(): void
    {
        // ...
        //$this->hasErrors = true;
        //$this->error = "Error 2"; 
        echo "<br>Starting Worker2 ID {$this->id}...<br>";
    }

    public function shutdown(): void
    {
        // ...
        echo "<br>Stopping Worker2 ID {$this->id}...<br>";
    }
}
