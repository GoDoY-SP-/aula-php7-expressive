<?php
namespace CodeEmailMKT\Infrastructure\Storage;

use Aura\Session\Session;
use Interop\Container\ContainerInterface;

class AuthenticationStorageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var Session $session */
        $session = $container->get(Session::class);

        return new AuthenticationStorage($session);
    }
}
