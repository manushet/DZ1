<?php

declare(strict_types = 1);

namespace Clients\Logger;

use ErrorException;
use \Exception;

class Logger
{
    public const INFO = "INFO";
    public const DEBUG = "DEBUG";
    public const WARN = "WARN";
    public const ERROR = "ERROR";
   
    public function log($logLevel, $message)
    {
        $filename = 'app/logger/' . strtolower($logLevel) . "_log.txt";          
        
        $timestamp = date('[Y-m-d H:i:s]');

        $logEntry = "$timestamp [$logLevel]: $message\r\n";

        try {
            echo "<br>Writing to the log.file {$filename}...<br>";

        }
        catch (Exception $e) {
            throw new ErrorException("Unable to open the log file {$filename}");
        }
    }
}