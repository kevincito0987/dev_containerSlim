<?php 

namespace App\Controllers;
use App\UseCases\CreateUser;
use App\Domain\Repositories\UserRepositoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\DTOs\CreateUserDTO;

class UserController {
    public function __construct(private UserRepositoryInterface $repo) {}

    private CreateUser $useCase;

    public function createUser(Request $request, Response $response): Response {
        $data = $request->getParsedBody();

        $dto = new CreateUserDTO(
            $data['nombre'],
            $data['email'],
            $data['password'],
            $data['rol'] ?? 'user'
        );

        $userDTO = $this->useCase->execute($dto);

        $response->getBody()->write(json_encode($userDTO));
        return $response->withStatus(201);
    }

    public function createAdmin(Request $request, Response $response): Response
    {
        //TODO: Se debe implementar con Caso de USOOOOOOO!
        $data = $request->getParsedBody();
        $data['rol'] = 'admin';
        //DTO
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $user = $this->repo->create($data);

        $response->getBody()->write(json_encode($user));
        return $response->withStatus(201);
    }
}





?>