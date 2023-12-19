<?php 
declare(strict_types = 1);

namespace Clients\Server;

use Config\Routes;
use Config\Services;
use Clients\Server\ServerConfig;
use Clients\Utils\Exception\NotAllowedRequestMethodException;
use Kernel\StartStopperInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Server implements StartStopperInterface 
{
    
    private Request $request;

    private Response $response;
    
    public function __construct(
        public ServerConfig $config, 
        public Routes $routes, 
        public Services $services,
    ) 
    {

    }
    
    public function start(): void 
    {    
        echo "<br>Server has started successfully!<br>";

        $this->routes->parseRoute("routes.yaml");

        $this->services->parseService("services.yaml");
    }

    public function sendRequest(): void
    {
        echo "<br>Processing http request...<br>";

        $this->request = Request::createFromGlobals();

        $this->response = $this->createResponse();
    }

    private function createResponse(): Response
    {
        $controllerHandler = $this->resolveControllerHandler();

        if (isset($controllerHandler["class"])) {
           
            $controller = $this->services->load($controllerHandler["class"]);
        
            $response = $controller->handle($this->request, $controllerHandler["action"]);

            return $response;

        } else {
            return new Response('Not Found', 404);
        }
    }
    
    private function resolveControllerHandler(): array
    {
        $controller = [];

        $route = $this->request->getPathInfo();

        if (isset($this->routes->routeMap[$route])) {
            $controller = $this->routes->routeMap[$route]; 

            $this->validateRequestMethod($controller["method"]);
        } 

        return $controller;
    }   

    public function validateRequestMethod(array $allowedMethods): void 
    {
        $requestMethod = $this->request->getMethod();

        if (!in_array($requestMethod, $allowedMethods)) {
            throw new NotAllowedRequestMethodException("Request method $requestMethod is not allowed for the route.");
        }
    }     
    
    public function getResponse(): Response 
    {
        return $this->response;
    }    

    public function shutdown(): void 
    {
        echo "<br>Server has stopped!<br>";
    }      
}