<?php

require_once "vendor/autoload.php";

use Slim\Factory\AppFactory;
use Dotenv\Dotenv;

$container = require_once __DIR__ . '/bootstrap/container.php';

AppFactory::setContainer($container);
$app = AppFactory::create();

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

(require_once __DIR__ . '/public/index.php')($app);
(require_once __DIR__ . '/routes/campers.php')($app);


$app->run();


?>