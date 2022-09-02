<?php

namespace App\DataFixtures;

use App\Entity\Subscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class SubscriptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 3; $i++) {
            $subscription = new Subscription();
            $subscription->setType($faker->word());
            $subscription->setDescription($faker->text());
            $subscription->setPrice($faker->randomNumber());
            $this->addReference('SUBSCRIPTION_' . $faker->unique()->numberBetween(11, 13), $subscription);


            $manager->persist($subscription);
        }
        $manager->flush();
    }
}
