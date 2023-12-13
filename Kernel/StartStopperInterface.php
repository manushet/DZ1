<?php
declare(strict_types = 1);

namespace Kernel;

interface StartStopperInterface {
    public function start(): void;

    public function shutdown(): void;
}