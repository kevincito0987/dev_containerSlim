<?php

namespace App\Domains\Repositories;

use App\Domains\Models\Camper;


interface CamperRepositoryInterface {
    public function getAll(): array;
    public function getById(int $documento): ?Camper;
    public function create(array $data): Camper;
    public function update(int $documento, array $data): bool;
    public function delete(int $documento): bool;
}












?>