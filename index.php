<?php 
declare(strict_types = 1);

require_once __DIR__.'/Config.php';
require_once __DIR__.'/Clients/Repository/Repository.php';
require_once __DIR__.'/Clients/Server/Server.php';
require_once __DIR__.'/Clients/Worker/Worker1.php';
require_once __DIR__.'/Clients/Worker/Worker2.php';
require_once __DIR__.'/Clients/Worker/Worker3.php';
require_once __DIR__.'/Kernel/Kernel.php';

use Kernel\Kernel;
use Clients\Server\Server;
use Clients\Worker\Worker1;
use Clients\Worker\Worker2;
use Clients\Worker\Worker3;
use Clients\Repository\Repository;

//echo phpinfo();

$config = new Config();

$repository = new Repository($config->repositoryConfig);

$server = new Server($config->serverConfig);

var_dump($config->repositoryConfig);

var_dump($config->serverConfig);

$kernel = new Kernel([$repository, $server]);

$kernel->run();

$worker1 = new Worker1("worker1-1");
$kernel->runWorker($worker1);

$worker2 = new Worker2("worker2-1");
$kernel->runWorker($worker2);

$worker3 = new Worker3("worker3-1");
$kernel->runWorker($worker3);

$workers = [$worker1, $worker2, $worker3];

//Getting Shutdown/Timeout/Cancel Signal...

$kernel->stopWorkers($workers);

$kernel->shutdown();
