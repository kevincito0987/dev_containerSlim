<?php 

namespace App\Infrastructure\Repositories;
use App\Domains\Models\Camper;
use App\Domains\Repositories\CamperRepositoryInterface;


class EloquentCamperRepositorie implements CamperRepositoryInterface{
    public function getAll(): array {
        //Select * FROM campers;
        return Camper::all()->toArray();
    }

    public function getById(int $documento): ?Camper {
        //Select * FROM campers WHERE id = $documento;

        return Camper::find($documento);
    }
    public function create(array $data): Camper {
        return Camper::create($data);
    }    

    public function update(int $documento, array $data): bool {
        $camper = Camper::find($documento);
        return $camper ? $camper->update($data) : false;
    }
    public function delete(int $documento): bool {
        //Delete FROM campers WHERE id = $documento;
        $camper = Camper::find($documento);
        return $camper ? $camper->delete() : false;
    }
}




?>