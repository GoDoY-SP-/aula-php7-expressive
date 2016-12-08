<?php
namespace CodeEmailMKT\Infrastructure\Service;

use Aura\Session\Session;
use CodeEmailMKT\Domain\Storage\AuthenticationStorageInterface;
use Interop\Container\ContainerInterface;

class AuthenticationServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var Session $session */
        $session = $container->get(Session::class);

        /** @var AuthenticationService $authService */
        $authService = $container->get(\Zend\Authentication\AuthenticationService::class);

        /** @var AuthenticationStorageInterface $storage */
        $storage = $container->get(AuthenticationStorageInterface::class);

        // Setar storage
        $authService->setStorage($storage);

        return new AuthenticationService($session, $authService);
    }
}
