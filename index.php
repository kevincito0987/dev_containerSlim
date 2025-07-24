<?php

require_once "vendor/autoload.php";

use App\Infrastructure\Database\Connection;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/');
$dotenv->load();

$container = require_once 'bootstrap/container.php';

AppFactory::setContainer($container);

Connection::init();

$app = AppFactory::create();

(require_once  'public/index.php')($app);
(require_once  'routes/campers.php')($app);


$app->run();


?>