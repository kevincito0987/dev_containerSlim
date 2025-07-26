<?php 

namespace App\Domain\Repositories;
use App\Domain\Models\User;


class UserRepositoryInterface {

    public function create(array $data): User;

}


?>