<?php 

namespace App\Infrastructure\Repositories;
use App\Domain\Models\User;
use App\Domain\Repositories\UserRepositoryInterface;
use App\DTOs\CreateUserDTO;
use DomainException;
use App\DTOs\CreateAdminDTO;


class EloquentUserRepository implements UserRepositoryInterface {
    public function create(CreateUserDTO $dto): User
    {
        $data = $dto->toArray();
        $exists = User::where('email', $data['email'])->first();
        if ($exists) {
            //Mostrar un error
            throw new DomainException('Ya existe un usuario con ese correo.');
        }

        return User::create($data);
    }

    public function createAdmin(CreateAdminDTO $dto): User
    {
        $data = $dto->toArray();
        $exists = User::where('email', $data['email'])->first();
        if ($exists) {
            //Mostrar un error
            throw new DomainException('Ya existe un usuario con ese correo.');
        }

        return User::create($data);
    }
}


?>