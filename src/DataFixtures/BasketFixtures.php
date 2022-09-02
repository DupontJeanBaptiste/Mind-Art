<?php

namespace App\DataFixtures;

use App\Entity\Basket;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class BasketFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $basket = new Basket();
            $basket->setValidation($faker->boolean());
            $basket->setStatus($faker->word());
            $basket->setUser($this->getReference('USER_' . $faker->numberBetween(1, 5)));
            $basket->setMasterpiece($this->getReference('MASTERPIECE_' . $faker->numberBetween(6, 10)));

            $manager->persist($basket);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          UserFixtures::class,
          MasterpieceFixtures::class,
        ];
    }
}
