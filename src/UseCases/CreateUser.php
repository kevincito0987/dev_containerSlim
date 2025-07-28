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
        $user = $this->repository->create($dto);

        return new UserResponseDTO(
            $user->id,
            $user->nombre,
            $user->email,
            $user->rol
        );
    }
}



?>