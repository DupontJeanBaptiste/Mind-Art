<?php

namespace App\DataFixtures;

use App\Entity\Discussion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class DiscussionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $discussion = new Discussion();
            $discussion->setSeller($this->getReference('USER_' . $faker->numberBetween(1, 5)));
            $discussion->setBuyer($this->getReference('USER_' . $faker->numberBetween(1, 5)));
            $discussion->setDate($faker->date());
            $this->addReference('DISCUSSION_' . $faker->unique()->numberBetween(1, 5), $discussion);
            $manager->persist($discussion);
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
