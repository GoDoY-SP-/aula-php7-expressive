<?php
namespace CodeEmailMKT\Infrastructure\Service;

use Interop\Container\ContainerInterface;

class AuthenticationServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var AuthenticationService $authService */
        $authService = $container->get(\Zend\Authentication\AuthenticationService::class);

        return new AuthenticationService($authService);
    }
}
