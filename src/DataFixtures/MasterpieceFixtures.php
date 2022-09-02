<?php

namespace App\DataFixtures;

use App\Entity\Masterpiece;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class MasterpieceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $masterpiece = new Masterpiece();
            $masterpiece->setName($faker->name());
            $masterpiece->setPrice($faker->randomNumber());
            $masterpiece->setDescription($faker->text());
            $masterpiece->setDisplay($faker->boolean());
            $masterpiece->setStatus($faker->word());
            $masterpiece->setPicture($faker->imageUrl(360, 360, 'animals', true, 'cats'));
            $masterpiece->setUser($this->getReference('USER_' . $faker->unique()->numberBetween(1, 5)));
            $this->addReference('MASTERPIECE_' . $faker->unique()->numberBetween(6, 10), $masterpiece);
            $manager->persist($masterpiece);
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
