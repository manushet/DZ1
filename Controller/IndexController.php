<?php

namespace Controller;

use Service\Service1;
use Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{

    public function __construct(public Service1 $service1, public string $arg1)
    {

    }

    protected function action1(Request $request): Response
    {
        return new Response("Response from IndexController->action1()", 200);
    }
}
