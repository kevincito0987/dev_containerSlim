<?php 

namespace App\Controllers;
use App\UseCases\CreateUser;
use App\Domain\Repositories\UserRepositoryInterface;
use App\DTOs\CreateAdminDTO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\DTOs\CreateUserDTO;
use App\UseCases\CreateAdmin;

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

        $useCase = new CreateUser($this->repo);
        $userDTO = $useCase->execute($dto);

        $response->getBody()->write(json_encode($userDTO));
        return $response->withStatus(201);
    }

    public function createAdmin(Request $request, Response $response): Response {
        $data = $request->getParsedBody();
    
        $dto = new CreateAdminDTO(
            $data['nombre'],
            $data['email'],
            $data['password']
        );
    
        $useCase = new CreateAdmin($this->repo);
        $userDTO = $useCase->execute($dto);
    
        $response->getBody()->write(json_encode($userDTO));
        return $response->withStatus(201);
    }
}





?>