<?php

declare(strict_types=1);

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Clients\Utils\Exception\UnknownControllerActionException;

abstract class Controller
{
    public function handle(Request $request, string $action): Response 
    {
        if (method_exists(static::class, $action)) {
            return $this->$action($request);
        } 

        throw new UnknownControllerActionException();
    }
}