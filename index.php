<?php 

require_once "vendor/autoload.php";

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->get('/', function(Request $req, Response $res, array $args) {
    $res->getBody()->write(
        json_encode([
            "message" => "Hello World"
        ])
    );
        return $res;
});

//Get/camper
//Post/camper
//Put/camper
//Delete/camper

$app->run();