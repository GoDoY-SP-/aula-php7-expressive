<?php

namespace CodeEmailMKT\Application\Middleware;

use CodeEmailMKT\Domain\Service\BootstrapInterface;
use CodeEmailMKT\Domain\Service\FlashMessageInterface;
use CodeEmailMKT\Infrastructure\Bootstrap;
use Interop\Container\ContainerInterface;

class BootstrapMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var BootstrapInterface $bootstrap */
        $bootstrap = new Bootstrap();

        /** @var FlashMessageInterface $flashMessage */
        $flashMessage = $container->get(FlashMessageInterface::class);

        return new BootstrapMiddleware($bootstrap, $flashMessage);
    }
}
