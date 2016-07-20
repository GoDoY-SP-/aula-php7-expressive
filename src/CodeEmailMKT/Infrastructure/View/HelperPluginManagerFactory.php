<?php

namespace CodeEmailMKT\Infrastructure\View;

use Interop\Container\ContainerInterface;
use Zend\View\HelperPluginManager;
use Zend\View\Renderer\PhpRenderer;

class HelperPluginManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        // Carregar configurações gerais
        $config = $container->get('config');

        // Criar view helper manager
        $viewHelpers = $config['view_helpers'];
        $manager = new HelperPluginManager($container, $viewHelpers);

        // Criar renderizador setando o helper manager
        $phpRender = new PhpRenderer();
        $phpRender->setHelperPluginManager($manager);

        return $manager;
    }
}
