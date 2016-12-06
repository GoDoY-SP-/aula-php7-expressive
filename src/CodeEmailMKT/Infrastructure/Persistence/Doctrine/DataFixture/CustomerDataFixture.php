<?php
namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\DataFixture;

use CodeEmailMKT\Domain\Entity\CustomerEntity;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as Faker;

class CustomerDataFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Faker
        $faker = Faker::create();
        foreach (range(1, 100) as $value) {
            // Criar entidade
            $customer = new CustomerEntity();

            // Setar dados
            $customer
                ->setName($faker->firstName . ' ' . $faker->lastName)
                ->setEmail($faker->email);

            // Persistir
            $manager->persist($customer);
        }

        $manager->flush();
    }
}