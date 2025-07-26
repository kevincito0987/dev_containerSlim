<?php 

namespace App\UseCases;
use App\Domain\Repositories\UserRepositoryInterface as UserRepository;
use App\DTOs\CreateUserDTO;


class CreateUser {
    private UserRepository $repository;

    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    public function execute(CreateUserDTO $dto): UserResponseDTO {
        $data = [
            'nombre' => $dto->nombre,
            'email' => $dto->email,
            'rol' => $dto->rol,
            'password' => password_hash($dto->password, PASSWORD_DEFAULT),
        ];
    
        $userModel = $this->repository->create($data);
    
        return new UserResponseDTO(
            $userModel->id,
            $userModel->nombre,
            $userModel->email,
            $userModel->rol
        );
    }
    
}





?>