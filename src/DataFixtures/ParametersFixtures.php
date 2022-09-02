<?php

namespace App\DataFixtures;

use App\Entity\Parameters;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ParametersFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $parameters = new Parameters();
            $parameters->setPicture($faker->imageUrl(640, 480, 'animals', true));
            $parameters->setBackground($faker->imageUrl(360, 360, 'animals', true, 'cats'));
            $parameters->setUser($this->getReference('USER_' . $faker->unique()->numberBetween(1, 5)));
            $manager->persist($parameters);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          UserFixtures::class,
        ];
    }
}
