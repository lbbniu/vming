<?php

ini_set('error_reporting', E_ALL | E_STRICT);
ini_set('display_errors', 1);

require __DIR__ . '/../init_autoloader.php';

use Lbb\Engine;

$engine = new Engine(__DIR__ . '/..');

$engine
    ->loadModules(include __DIR__ . '/../config/modules.' . $engine->getAppName() . '.php')
    ->bootstrap()
    ->run();
