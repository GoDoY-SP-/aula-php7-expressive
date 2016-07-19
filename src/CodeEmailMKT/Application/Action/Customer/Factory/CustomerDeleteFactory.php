<?php

namespace CodeEmailMKT\Application\Action\Customer\Factory;

use CodeEmailMKT\Application\Action\Customer\CustomerDeleteAction;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CustomerDeleteFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $repository = $container->get(CustomerRepositoryInterface::class);
        $template = $container->get(TemplateRendererInterface::class);

        return new CustomerDeleteAction($repository, $template);
    }
}
