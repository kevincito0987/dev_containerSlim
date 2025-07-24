<?php

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use App\Middleware\JsonBodyParserMiddleware;

return function (App $app) {
    //Middleware
    //Global Middleware

    $app->add(function (Request $req, Handler $han): Response {
        $response = $han->handle($req);
        return $response->withHeader('Content-Type', 'application/json');
    });

$app->add(new JsonBodyParserMiddleware());

};

?>