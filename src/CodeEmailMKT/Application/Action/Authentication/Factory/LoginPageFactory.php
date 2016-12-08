<?php

namespace CodeEmailMKT\Application\Action\Authentication\Factory;

use CodeEmailMKT\Application\Action\Authentication\LoginPageAction;
use CodeEmailMKT\Application\Form\LoginForm;
use CodeEmailMKT\Domain\Service\AuthenticationServiceInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Expressive\Router\RouterInterface;

class LoginPageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $router = $container->get(RouterInterface::class);
        $template = $container->get(TemplateRendererInterface::class);
        $form = $container->get(LoginForm::class);
        $authService = $container->get(AuthenticationServiceInterface::class);

        return new LoginPageAction($router, $template, $form, $authService);
    }
}
