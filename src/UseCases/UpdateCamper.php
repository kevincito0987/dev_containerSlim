<?php 

namespace App\UseCases;
use App\Domains\Models\Camper;
use App\Domains\Repositories\CamperRepositoryInterface;

class UpdateCamper {

    public function __construct(private CamperRepositoryInterface $repo)
    {}
    public function execute(int $documento, array $data): bool {
        return $this->repo->update($documento, $data);
    }
}




















?>