<?php 

namespace App\Infrastructure\Repositories;
use App\Domain\Models\User;
use App\Domain\Repositories\UserRepositoryInterface;
use App\DTOs\CreateUserDTO;
use Exception;


class EloquentUserRepository implements UserRepositoryInterface {
    public function create(CreateUserDTO $dto): User
    {
        $data = $dto->toArray();
        $exists = User::where('email', $data['email'])->first();
        if ($exists) {
            //Mostrar un error
            throw new Exception('Error el usuario ya existe');
        }

        return User::create($data);
    }
}


?>