<?php
use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
            Helper\ServerUrlHelper::class => Helper\ServerUrlHelper::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            Application::class => ApplicationFactory::class,
            Helper\UrlHelper::class => Helper\UrlHelperFactory::class,
            CodeEmailMKT\Domain\Service\FlashMessageServiceInterface::class => CodeEmailMKT\Infrastructure\Service\FlashMessageServiceFactory::class,
            'doctrine:fixtures_cmd:load' => \CodeEdu\FixtureFactory::class,
            CodeEmailMKT\Domain\Service\AuthenticationServiceInterface::class => CodeEmailMKT\Infrastructure\Service\AuthenticationServiceFactory::class,
            // Repository
            CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface::class => CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository\CustomerRepositoryFactory::class,
            CodeEmailMKT\Domain\Persistence\UserRepositoryInterface::class => CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository\UserRepositoryFactory::class,
        ],
        // Use 'aliases'
        'aliases' => [
            'Configuration' => 'config', //Doctrine needs a service called Configuration
            'Config' => 'config', //Doctrine needs a service called Configuration
            \Zend\Authentication\AuthenticationService::class => 'doctrine.authenticationservice.orm_default'
        ],
    ],
];
