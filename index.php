<?php 

require_once "vendor/autoload.php";

use App\Middleware\JsonBodyParserMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Psr\Http\Server\RequestHandlerInterface as Handler;

$app = AppFactory::create();

$app->get('/', function(Request $req, Response $res, array $args) {
    $res->getBody()->write(
        json_encode([
            "message" => "Hello World"
        ])
    );
        return $res;
});
//Middleware
//Global Middleware

$app->add(function(Request $req, Handler $han): Response {
    $response = $han->handle($req);
    return $response->withHeader("Content-Type", "application/json");
});



$app->add(new JsonBodyParserMiddleware());



//Get/camper
//Post/camper
//Put/camper/1
//Patch/camper/1
//Delete/camper/1

$app->get('/camper/{name}/{skill}', function(Request $req, Response $res, array $args) {
    $name = $args['name'];
    $skill = $args['skill'];
    $res->getBody()->write(
        json_encode([$name, $skill])
    );
        return $res;
})->add(function(Request $req, Handler $han): Response {
    $response = $han->handle($req);
    return $response->withHeader("X-Powered-By", "Slim Framework");
});

$app->get('/camper', function(Request $req, Response $res, array $args) {

    $params = $req->getQueryParams();
    $name = $params['name'] ?? "default";
    $skill = $params['skill'] ?? "default";
    $res->getBody()->write(
        json_encode([$name, $skill])
    );
        return $res;
});

$app->post('/camper', function(Request $req, Response $res, array $args) {
    $data = $req->getParsedBody();
    $res->getBody()->write(
        json_encode($data)
    );
        return $res->withStatus(201);
});
$app->run();