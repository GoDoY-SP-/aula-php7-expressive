<?php

$forms = [
    'dependencies' => [
        'aliases' => [

        ],
        'invokables' => [

        ],
        'factories' => [
            Zend\View\HelperPluginManager::class => CodeEmailMKT\Infrastructure\View\HelperPluginManagerFactory::class,
            CodeEmailMKT\Application\Form\CustomerForm::class => CodeEmailMKT\Application\Form\Factory\CustomerFormFactory::class,
            CodeEmailMKT\Application\Form\LoginForm::class => CodeEmailMKT\Application\Form\Factory\LoginFormFactory::class,
        ]
    ],
    'view_helpers' => [
        'aliases' => [

        ],
        'invokables' => [

        ],
        'factories' => [
            'identity' => \Zend\View\Helper\Service\IdentityFactory::class
        ]
    ],
];

$configProviderForm = (new \Zend\Form\ConfigProvider())->__invoke();

return \Zend\Stdlib\ArrayUtils::merge($forms, $configProviderForm);