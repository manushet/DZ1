<?php

declare(strict_types = 1);

namespace Clients\Utils;

use Kernel\StartStopperInterface;
use \Exception;
use Clients\Logger\Logger;

abstract class Worker implements StartStopperInterface
{
    protected string $id;

    public bool $isRunning = false;

    public bool $hasErrors = false;

    public string $error;

    public function __construct($id)
    {
        $this->id = $id;     
    }
   
    abstract public function start(): void;

    public function prepareStart(): void
    {
        $log = new Logger();
        
        try {

            $this->start();

            if (!$this->hasErrors) {
                $this->isRunning = true;
                echo "<br>Worker ID {$this->id} has started successfully<br>";
            }
            else {   
                $logMsg = "Something went wrong while starting Worker ID {$this->id}: {$this->error}";
                
                echo "<br>$logMsg<br>";
                
                $log->log(Logger::ERROR, $logMsg);

                $this->prepareShutdown();
            }
        } 
        catch (Exception $e) {
            $log->log(Logger::ERROR, "Failed to run Worker ID {$this->id}: {$e->getMessage()}");
        }
    }    

    abstract public function shutdown(): void;     
    
    public function prepareShutdown(): void
    {
        $this->shutdown();

        $this->isRunning = false;
        echo "<br>Worker ID {$this->id} has stopped<br>";
    }      
}
