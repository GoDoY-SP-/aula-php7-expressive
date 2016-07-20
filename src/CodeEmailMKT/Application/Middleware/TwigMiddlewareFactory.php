<?php

namespace CodeEmailMKT\Application\Middleware;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\View\HelperPluginManager;

class TwigMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var TemplateRendererInterface $twigRender */
        $twigRender = $container->get(TemplateRendererInterface::class);
        $twigEnvironment = $twigRender->getTemplate();
        $helperManager = $container->get(HelperPluginManager::class);

        return new TwigMiddleware($twigEnvironment, $helperManager);
    }
}
