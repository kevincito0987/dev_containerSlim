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

    public function createUser(Request $request, Response $response): Response {
        $data = $request->getParsedBody();
    
        try {
            $dto = new CreateUserDTO(
                nombre: $data['nombre'] ?? '',
                email: $data['email'] ?? '',
                password: $data['password'] ?? '',
                rol: 'user'
            );
    
            $useCase = new CreateUser($this->repo);
            $userDTO = $useCase->execute($dto);
    
            $response->getBody()->write(json_encode($userDTO));
            return $response->withStatus(201);
        } catch (\InvalidArgumentException $e) {
            $response->getBody()->write(json_encode([
                'error' => 'Validación fallida',
                'detalles' => $e->getMessage()
            ]));
            return $response->withStatus(422);
        }
    }
    

    public function createAdmin(Request $request, Response $response): Response {
        $data = $request->getParsedBody();
    
        try {
            $dto = new CreateAdminDTO(
                nombre: $data['nombre'] ?? '',
                email: $data['email'] ?? '',
                password: $data['password'] ?? ''
            );
    
            $useCase = new CreateAdmin($this->repo);
            $userDTO = $useCase->execute($dto);
    
            $response->getBody()->write(json_encode($userDTO));
            return $response->withStatus(201);
        } catch (\InvalidArgumentException $e) {
            $response->getBody()->write(json_encode([
                'error' => 'Datos inválidos',
                'mensaje' => $e->getMessage()
            ]));
            return $response->withStatus(422);
        } catch (\DomainException $e) {
            $response->getBody()->write(json_encode([
                'error' => 'Conflicto de datos',
                'mensaje' => $e->getMessage()
            ]));
            return $response->withStatus(409);
        }
    }
    
}


?>