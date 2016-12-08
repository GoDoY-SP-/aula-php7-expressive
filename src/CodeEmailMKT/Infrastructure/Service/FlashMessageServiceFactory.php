<?php

namespace CodeEmailMKT\Infrastructure\Service;

use Interop\Container\ContainerInterface;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class FlashMessageServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var FlashMessenger $flashMessenger */
        $flashMessenger = new FlashMessenger();

        return new FlashMessageService($flashMessenger);
    }
}
