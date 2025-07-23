<?php 

namespace App\Infrastructure\Database;

use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;

class Connection {

    public static function init(): string|bool {

        $capsule = new Capsule;
        $capsule->addConnection(
            [
                'driver'    => 'mysql',
                'host'      => '127.0.0.1',
                'database'  => 'taller_slim',
                'username'  => 'root',
                'password'  => 'admin',
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
            ]
        );
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        try {
            Capsule::connection()->getPdo();
            return true;
        } catch (Exception $ex) {
            return "Error al conectar a la base de datos: " . $ex->getMessage();
        }
    }

}









?>