<?php 

namespace App\UseCases;
use App\Domains\Models\Camper;
use App\Domains\Repositories\CamperRepositoryInterface;

class GetCamperById {

    public function __construct(private CamperRepositoryInterface $repo)
    {}
    public function execute(int $documento): ?Camper {
        return $this->repo->getById($documento);
    }
}

















?>