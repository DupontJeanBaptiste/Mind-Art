<?php

namespace App\DataFixtures;

use App\Entity\Messages;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class MessagesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $messages = new Messages();
            $messages->setDiscussion($this->getReference('DISCUSSION_' . $faker->numberBetween(1, 5)));
            $messages->setTime($faker->time($format = 'H:i:s', $max = 'now'));
            $messages->setMessage($faker->sentence());
            $messages->setView(false);
            $manager->persist($messages);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          DiscussionFixtures::class,
        ];
    }
}
