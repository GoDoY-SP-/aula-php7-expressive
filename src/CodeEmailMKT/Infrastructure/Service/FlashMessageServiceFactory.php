<?php

namespace CodeEmailMKT\Infrastructure\Service;

use Aura\Session\Session;
use Interop\Container\ContainerInterface;

class FlashMessageServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var Session $session */
        $session = $container->get(Session::class);

        return new FlashMessageService($session);
    }
}
