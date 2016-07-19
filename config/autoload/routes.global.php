<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\AuraRouter::class,
            CodeEmailMKT\Application\Action\PingAction::class => CodeEmailMKT\Application\Action\PingAction::class,
        ],
        'factories' => [
            CodeEmailMKT\Application\Action\HomePageAction::class => CodeEmailMKT\Application\Action\HomePageFactory::class,
            CodeEmailMKT\Application\Action\TestePageAction::class => CodeEmailMKT\Application\Action\TestePageFactory::class,
            CodeEmailMKT\Application\Action\Customer\CustomerListAction::class => CodeEmailMKT\Application\Action\Customer\Factory\CustomerListFactory::class,
            CodeEmailMKT\Application\Action\Customer\CustomerCreateAction::class => CodeEmailMKT\Application\Action\Customer\Factory\CustomerCreateFactory::class,
            CodeEmailMKT\Application\Action\Customer\CustomerUpdateAction::class => CodeEmailMKT\Application\Action\Customer\Factory\CustomerUpdateFactory::class,
            CodeEmailMKT\Application\Action\Customer\CustomerDeleteAction::class => CodeEmailMKT\Application\Action\Customer\Factory\CustomerDeleteFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => CodeEmailMKT\Application\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => CodeEmailMKT\Application\Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'teste',
            'path' => '/teste',
            'middleware' => CodeEmailMKT\Application\Action\TestePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'customer.list',
            'path' => '/admin/customers',
            'middleware' => CodeEmailMKT\Application\Action\Customer\CustomerListAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'customer.create',
            'path' => '/admin/customer/create',
            'middleware' => CodeEmailMKT\Application\Action\Customer\CustomerCreateAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'customer.update',
            'path' => '/admin/customer/update/{id}',
            'middleware' => CodeEmailMKT\Application\Action\Customer\CustomerUpdateAction::class,
            'allowed_methods' => ['GET', 'POST'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
        [
            'name' => 'customer.delete',
            'path' => '/admin/customer/delete/{id}',
            'middleware' => CodeEmailMKT\Application\Action\Customer\CustomerDeleteAction::class,
            'allowed_methods' => ['GET', 'POST'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
    ],
];
