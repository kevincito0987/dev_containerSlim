<?php


namespace App\Controllers;

use App\Domains\Repositories\CamperRepositoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\UseCases\GetAllCampers;
use App\UseCases\GetCamperById;
use App\UseCases\CreateCamper;
use App\UseCases\UpdateCamper;


class CamperController
{

    public function __construct( private CamperRepositoryInterface $repo) {}
    public function index(Request $request, Response $response): Response
    {
        $useCase = new GetAllCampers($this->repo);
        $campers = $useCase->execute();
        $response->getBody()->write(json_encode($campers));
        return $response;
    }
    public function show(Request $request, Response $response, array $args): Response
    {
        $useCase = new GetCamperById($this->repo);
        $camper = $useCase->execute((int)$args['documento']);
        if (!$camper) {
            $response->getBody()->write(json_encode(['error' => 'Camper no encontrado en la plataforma']));
            return $response->withStatus(404);
        }
        $response->getBody()->write(json_encode($camper));
        return $response;
    }
    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $useCase = new CreateCamper($this->repo);
        $camper = $useCase->execute($data);
        if (!$camper) {
            $response->getBody()->write(json_encode(['error' => 'Error al crear el camper']));
            return $response->withStatus(500);
        }
        $response->getBody()->write(json_encode($camper));
        return $response;
    }
    public function update(Request $request, Response $response, array $args): Response
    {
        $documento = (int)$args['documento'];
        $data = $request->getParsedBody();
        $useCase = new UpdateCamper($this->repo);
        $success = $useCase->execute($documento, $data);
        if (!$success) {
            $response->getBody()->write(json_encode(['error' => 'Error al actualizar el camper']));
            return $response->withStatus(500);
        }
        $response->getBody()->write(json_encode(['success' => 'Camper actualizado correctamente']));
        return $response->withStatus(204);
    }
    public function destroy(Request $request, Response $response): Response
    {
        return $response;
    }
}
