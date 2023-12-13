<?php 
declare(strict_types = 1);

namespace Kernel;

use Clients\Utils\Worker;
use Kernel\StartStopperInterface;

class Kernel 
{
        
    /** 
     * @param []StartStopperInterface $services
     * 
     */
    public function __construct(public array $services) {
    } 

    public function run() {
        foreach ($this->services as $service) {
            if ($service instanceof StartStopperInterface) {
                $service->start();
            }
        }
    }

    public function runWorker(Worker $worker) {
        $worker->prepareStart();
    }

    public function stopWorkers(array $workers) {
        
        echo "<br>Stopping all running workers!<br>";
        
        foreach ($workers as $worker) {
            if ($worker instanceof Worker) {
                if ($worker->isRunning) {
                    $worker->prepareShutdown();
                }
            }
        }        
    }  
    
    public function shutdown() {
        
        $reversedServices = array_reverse($this->services);

        foreach ($reversedServices as $service) {
            if ($service instanceof StartStopperInterface) {
                $service->shutdown();
            }
        }
    }   
}