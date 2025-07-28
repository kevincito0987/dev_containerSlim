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
        $admin = $this->repository->createAdmin($dto);

        return new UserResponseDTO(
            $admin->id,
            $admin->nombre,
            $admin->email,
            $admin->rol
        );
    }
}


?>