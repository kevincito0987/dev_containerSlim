<?php

namespace App\UseCases;
use App\Domain\Repositories\CamperRepositoryInterface;




class DeleteCamper {

    public function __construct(private CamperRepositoryInterface $repo) {}
    
    public function execute(int $documento): bool {
        return $this->repo->delete($documento);
    }
}

?>