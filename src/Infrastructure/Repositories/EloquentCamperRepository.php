<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Camper;
use App\Domain\Repositories\CamperRepositoryInterface;

class EloquentCamperRepository implements CamperRepositoryInterface
{

    public function getAll(): array
    {
        // SELECT * FROM campers;
        return Camper::all()->toArray();
    }

    public function getById(int $documento): ?Camper
    {
        // SELECT * FROM campers WHERE id = $documento;
        //return Camper::find($documento);

        //SELECT * FROM campers WHERE documento = $documento LIMIT 1,1;
        return Camper::where('documento', $documento)->first();
    }

    public function create(array $data): Camper
    {
        $exists = $this->getById($data['documento']);
        if ($exists) {
            return $exists;
        }
        return Camper::create($data);
    }

    public function update(int $documento, array $data): bool
    {
        // SELECT * FROM campers WHERE documento = $documento;
        $camper = $this->getById($data['documento']);
        // UPDATE campers SET nombre= $data[x] ... WHERE documento = $documento;
        return $camper ? $camper->update($data) : false;
    }

    public function delete(int $documento): bool
    {
        // SELECT * FROM campers WHERE id = $documento;
        $camper = Camper::find($documento);
        // DELETE FROM campers WHERE id = $documento;
        return $camper ? $camper->delete() : false;
    }
}
