<?php

namespace Controller;

use Service\Service2;
use Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ResourceController extends Controller
{

    public function __construct(public Service2 $service2, public string $arg2)
    {
        
    }

    protected function action2(Request $request): Response
    {
        return new Response("Response from ResourceController->action2()", 200);
    }    
}