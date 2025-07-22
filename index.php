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
//Put/camper/1
//Patch/camper/1
//Delete/camper/1

$app->get('/camper', function(Request $req, Response $res, array $args) {

    $params = $req->getQueryParams();
    $name = $params['name'] ?? "default";
    $skill = $params['skill'] ?? "default";
    $res->getBody()->write(
        json_encode([$name, $skill])
    );
        return $res;
});

$app->run();