<?php

namespace App\UseCases;
use App\DTOs\CreateAdminDTO;
use App\DTOs\UserResponseDTO;
use App\Domain\Repositories\UserRepositoryInterface;


class CreateAdmin {
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function execute(CreateAdminDTO $dto): UserResponseDTO {
        $data = [
            'nombre' => $dto->nombre,
            'email' => $dto->email,
            'rol' => 'admin',
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