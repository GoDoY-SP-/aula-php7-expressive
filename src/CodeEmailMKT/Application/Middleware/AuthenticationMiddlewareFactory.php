<?php

namespace CodeEmailMKT\Application\Middleware;

use CodeEmailMKT\Domain\Service\AuthenticationServiceInterface;
use CodeEmailMKT\Infrastructure\Service\AuthenticationService;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;

class AuthenticationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var RouterInterface router */
        $router = $container->get(RouterInterface::class);

        /** @var AuthenticationService $authService */
        $authService = $container->get(AuthenticationServiceInterface::class);

        return new AuthenticationMiddleware($router, $authService);
    }
}
