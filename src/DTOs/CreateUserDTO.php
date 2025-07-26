<?php 

namespace App\DTOs;


class CreateUserDTO {
    public string $nombre;
    public string $email;
    public string $password;
    public string $rol;

    public function __construct(string $nombre, string $email, string $password, string $rol = 'user') {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
    }
}


?>