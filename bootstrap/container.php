<?php

use App\Domain\Repositories\CamperRepositoryInterface;
use App\Infrastructure\Repositories\EloquentCamperRepository;
use DI\Container;


$container = new Container();

$container->set(CamperRepositoryInterface::class, function () {
    return new EloquentCamperRepository();
});

// new CamperController(new EloquentCamperRepository())

return $container;


?>