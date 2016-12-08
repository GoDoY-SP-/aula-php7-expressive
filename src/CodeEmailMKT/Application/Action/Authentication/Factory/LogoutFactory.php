<?php

namespace CodeEmailMKT\Application\Action\Authentication\Factory;

use CodeEmailMKT\Application\Action\Authentication\LogoutAction;
use CodeEmailMKT\Domain\Service\AuthenticationServiceInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;


class LogoutFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $router = $container->get(RouterInterface::class);
        $authService = $container->get(AuthenticationServiceInterface::class);

        return new LogoutAction($router, $authService);
    }
}
