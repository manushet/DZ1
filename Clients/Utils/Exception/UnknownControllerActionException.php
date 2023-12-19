<?php

declare(strict_types = 1);

namespace Clients\Utils\Exception;

use \Throwable;
use \Exception;

class UnknownControllerActionException extends Exception {
    public function __construct($message = "Unknown controller action defined", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
    
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}