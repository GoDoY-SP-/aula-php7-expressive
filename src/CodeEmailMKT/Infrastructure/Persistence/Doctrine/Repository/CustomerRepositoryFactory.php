<?php

namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository;

use CodeEmailMKT\Domain\Entity\CustomerEntity;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

class CustomerRepositoryFactory
{
    public function __invoke(ContainerInterface $container)
    {

        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);

        return $entityManager->getRepository(CustomerEntity::class);
    }
}
