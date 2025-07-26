<?php 

namespace App\UseCases;

use App\DTOs\CreateUserDTO;
use App\DTOs\UserResponseDTO;
use App\Domain\Repositories\UserRepositoryInterface;

class CreateUser {
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function execute(CreateUserDTO $dto): UserResponseDTO {
        $data = [
            'nombre' => $dto->nombre,
            'email' => $dto->email,
            'rol' => $dto->rol,
            'password' => password_hash($dto->password, PASSWORD_DEFAULT),
        ];

        $user = $this->repository->create($data);

        return new UserResponseDTO(
            $user->id,
            $user->nombre,
            $user->email,
            $user->rol
        );
    }
}


?>