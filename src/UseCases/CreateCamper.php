<?php 

namespace App\UseCases;
use App\Domains\Models\Camper;
use App\Domains\Repositories\CamperRepositoryInterface;

class CreateCamper {

    public function __construct(private CamperRepositoryInterface $repo)
    {}
    public function execute(array $data): ?Camper {
        return $this->repo->create($data);
    }
}





















?>