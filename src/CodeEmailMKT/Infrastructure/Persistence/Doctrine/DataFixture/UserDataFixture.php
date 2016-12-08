<?php
namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\DataFixture;


use CodeEmailMKT\Domain\Entity\UserEntity;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as Faker;

class UserDataFixture implements FixtureInterface
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

        // Usuário Padrão
        // Criar entidade
        $user = new UserEntity();

        // Setar dados
        $user
            ->setName('Admin')
            ->setEmail('admin@admin.adm')
            ->setPasswordPlain(123456);

        // Persistir
        $manager->persist($user);

        foreach (range(1, 100) as $value) {
            // Criar entidade
            $user = new UserEntity();

            // Setar dados
            $user
                ->setName($faker->firstName . ' ' . $faker->lastName)
                ->setEmail($faker->email)
                ->setPasswordPlain(123456);

            // Persistir
            $manager->persist($user);
        }

        $manager->flush();
    }
}