<?php

use App\Domain\Repositories\CamperRepositoryInterface;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Infrastructure\Repositories\EloquentCamperRepository;
use App\Infrastructure\Repositories\EloquentUserRepository;
use DI\Container;


$container = new Container();

$container->set(CamperRepositoryInterface::class, function () {
    return new EloquentCamperRepository();
});

// new CamperController(new EloquentCamperRepository())

$container->set(UserRepositoryInterface::class, function () {
    return new EloquentUserRepository();
});

// new CamperController(new EloquentCamperRepository())

return $container;


?>