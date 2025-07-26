<?php 

namespace App\DTOs;


class CreateAdminDTO {
    public string $nombre;
    public string $email;
    public string $password;

    public function __construct(string $nombre, string $email, string $password) {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
    }
}

?>