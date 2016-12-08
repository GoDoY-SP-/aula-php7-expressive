<?php

namespace CodeEmailMKT\Application\Middleware;

use CodeEmailMKT\Domain\Service\BootstrapServiceInterface;
use CodeEmailMKT\Domain\Service\FlashMessageServiceInterface;
use CodeEmailMKT\Infrastructure\Bootstrap;
use Interop\Container\ContainerInterface;

class BootstrapMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var BootstrapServiceInterface $bootstrap */
        $bootstrap = new Bootstrap();

        /** @var FlashMessageServiceInterface $flashMessage */
        $flashMessage = $container->get(FlashMessageServiceInterface::class);

        return new BootstrapMiddleware($bootstrap, $flashMessage);
    }
}
