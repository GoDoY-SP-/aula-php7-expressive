<?php

namespace CodeEmailMKT\Infrastructure;

use CodeEmailMKT\Domain\Service\BootstrapServiceInterface;

class Bootstrap implements BootstrapServiceInterface
{

    public function create()
    {
        require __DIR__ . '\config\doctrine.php';
    }
}