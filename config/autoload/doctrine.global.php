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
        'driver' => [
//            'CodeEmailMKT_annotation_driver' => [
//                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
//                'cache' => 'array',
//                'paths' => [__DIR__ . '/../../src/CodeEmailMKT/Entity']
//            ],
            'CodeEmailMKT_yaml_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\YamlDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../../src/CodeEmailMKT/Infrastructure/Persistence/Doctrine/ORM']
            ],
            'orm_default' => [
                'drivers' => [
                    'CodeEmailMKT\Domain\Entity' => 'CodeEmailMKT_yaml_driver'
                ]
            ]
        ],
        'annotations' => [
//            'paths' => [
////                'App/src/Entity',
//            ]
        ],
        'fixtures' => [
            'MyFixture' => __DIR__ . '/../../src/CodeEmailMKT/Infrastructure/Persistence/Doctrine/DataFixture'
        ],
        'authentication' => [
            'orm_default' => [
                'object_manager' => Doctrine\ORM\EntityManager::class,
                'identity_class' => CodeEmailMKT\Domain\Entity\UserEntity::class,
                'identity_property' => 'email',
                'credential_property' => 'password',
                'credential_callable' => function (\CodeEmailMKT\Domain\Entity\UserEntity $userEntity, $passwordGiven) {
                    return password_verify($passwordGiven, $userEntity->getPassword());
                }
            ]
        ]
    ],
];