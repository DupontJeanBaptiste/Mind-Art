<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $comment = new Comment();
            $comment->setComment($faker->sentence());
            $comment->setUser($this->getReference('USER_' . $faker->numberBetween(1, 5)));
            $comment->setMasterpiece($this->getReference('MASTERPIECE_' . $faker->numberBetween(6, 10)));
            $manager->persist($comment);
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
