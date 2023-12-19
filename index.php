<?php 
declare(strict_types = 1);

require_once "autoload.php";
require_once "vendor/autoload.php";

use Config\Config;
use Config\Routes;
use Kernel\Kernel;
use Config\Services;
use Clients\Server\Server;
use Clients\Worker\Worker1;
use Clients\Worker\Worker2;
use Clients\Worker\Worker3;
use Clients\Repository\Repository;

//echo phpinfo();

$config = new Config();

$routes = new Routes();

$services = new Services();

$repository = new Repository($config->repositoryConfig);

$server = new Server($config->serverConfig, $routes, $services);

var_dump($config->repositoryConfig);

var_dump($config->serverConfig);

$kernel = new Kernel([$repository, $server]);

$kernel->run();

$server->sendRequest();

$serverResponse = $server->getResponse(); 

var_dump($serverResponse);

$worker1 = new Worker1("worker1-1");
$worker2 = new Worker2("worker2-1");
$worker3 = new Worker3("worker3-1");

$workers = [$worker1, $worker2, $worker3];

$kernel->runWorkers($workers);

echo "<br>Ooops! Shutdown signal received. Preparing to the graceful shutdown...<br>";

$kernel->stopWorkers($workers);

$kernel->shutdown();