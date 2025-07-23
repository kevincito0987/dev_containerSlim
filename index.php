<?php

require_once "vendor/autoload.php";

use App\Middleware\JsonBodyParserMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Psr\Http\Server\RequestHandlerInterface as Handler;

$app = AppFactory::create();

//Middleware
//Global Middleware

$app->add(function (Request $req, Handler $han): Response {
    $response = $han->handle($req);
    return $response->withHeader("Content-Type", "application/json");
});



$app->add(new JsonBodyParserMiddleware());


$app->run();
