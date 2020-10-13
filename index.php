<?php
define("BASEPATH", __DIR__);
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/helpers.php';
use App\Application;
use App\Config\Commands;

$app = new Application();
$GLOBALS['app'] = $app;


Commands::register();
$app->getDiscord()->run();
