<?php
return [
    'doctrine' => [
        'orm' => [
            'auto_generate_proxy_classes' => false,
            'proxy_dir' => 'data/cache/EntityProxy',
            'proxy_namespace' => 'EntityProxy',
            'underscore_naming_strategy' => true,
        ],
        'connection' => [
            // default connection
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'host' => '127.0.0.1',
                    'port' => '3306',
                    'user' => '*****',
                    'password' => '*****',
                    'dbname' => '*****',
                    'driverOptions' => [
                        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
                    ]
                ],
            ],
        ],
        'cache' => [
//            'memcached' => [
//                'host' => '',
//                'port' => '',
//            ],
//            'redis' => [
//                'host' => '',
//                'port' => '',
//            ],
        ],
        'annotations' => [
            'paths' => [
//                'App/src/Entity',
            ]
        ]
    ],
];