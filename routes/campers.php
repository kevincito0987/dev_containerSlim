<?php

use App\Controllers\CamperController;
use App\Middleware\AutMiddleware;
use App\Middleware\RoleMiddleware;
use Slim\App;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {
    $app->group('/campers', function ($group) {
        $group->get('', [CamperController::class, 'index']);
        $group->get('/{documento}', [CamperController::class, 'show']);
        $group->post('', [CamperController::class, 'store']);
        $group->put('/{documento}', [CamperController::class, 'update']);
        $group->delete('/{documento}', [CamperController::class, 'destroy']);
    })->add(new RoleMiddleware('user'))
    ->add(new AutMiddleware());

    $app->group('/dashboard', function ($group) {
        $group->get('', function (Request $request, Response $response, array $args) {
            $response->getBody()->write("Hello desde admin");
            return $response;
        });
    })->add(new RoleMiddleware('admin'))
    ->add(new AutMiddleware());
};

?>
