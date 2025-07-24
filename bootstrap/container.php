<?php

use App\Domains\Repositories\CamperRepositoryInterface;
use App\Infrastructure\Repositories\EloquentCamperRepositorie;
use DI\Container;


$contaier = new Container();

$contaier->set(CamperRepositoryInterface::class, function () {
    return new EloquentCamperRepositorie();
});

return $contaier;

?>