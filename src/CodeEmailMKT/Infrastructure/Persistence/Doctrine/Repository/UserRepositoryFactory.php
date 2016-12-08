<?php

namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository;

use CodeEmailMKT\Domain\Entity\UserEntity;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

class UserRepositoryFactory
{
    public function __invoke(ContainerInterface $container)
    {

        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);

        return $entityManager->getRepository(UserEntity::class);
    }
}
