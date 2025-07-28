<?php 

namespace App\Domain\Repositories;

use App\Domain\Models\User;
use App\DTOs\CreateUserDTO;

interface   UserRepositoryInterface {

    public function create(CreateUserDTO $dto): User;

}


?>