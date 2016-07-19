<?php

namespace CodeEmailMKT\Application\Action\Customer\Factory;

use CodeEmailMKT\Application\Action\Customer\CustomerCreateAction;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CustomerCreateFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $repository = $container->get(CustomerRepositoryInterface::class);
        $template = $container->get(TemplateRendererInterface::class);

        return new CustomerCreateAction($repository, $template);
    }
}
