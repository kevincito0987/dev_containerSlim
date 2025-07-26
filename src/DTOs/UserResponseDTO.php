<?php 

namespace App\DTOs;


class UserResponseDTO {
    public int $id;
    public string $nombre;
    public string $email;
    public string $rol;

    public function __construct(int $id, string $nombre, string $email, string $rol) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->rol = $rol;
    }
}


?>