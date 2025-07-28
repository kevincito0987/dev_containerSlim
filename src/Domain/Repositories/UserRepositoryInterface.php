<?php 

namespace App\Domain\Repositories;

use App\Domain\Models\User;
use App\DTOs\CreateUserDTO;
use App\DTOs\CreateAdminDTO;

interface   UserRepositoryInterface {

    public function create(CreateUserDTO $dto): User;
    public function createAdmin(CreateAdminDTO $dto): User;

}


?>