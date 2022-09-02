<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setEmail($faker->email());
            $password = $this->hasher->hashPassword($user, 'user');
            $user->setRoles(['ROLE_SELLER']);
            $user->setPassword($password);
            $user->setLastname($faker->lastName());
            $user->setFirstname($faker->firstName());
            $user->setPseudo($faker->userName());
            $user->setPhone($faker->phoneNumber());
            $user->setBiography($faker->paragraph());
            $user->setSubscription($this->getReference('SUBSCRIPTION_' . $faker->numberBetween(11, 13)));
            $user->setIsVerified(true);
            $this->addReference('USER_' . $faker->unique()->numberBetween(1, 5), $user);

            $manager->persist($user);
        }
            $user = new User();
            $user->setEmail('sophie.verdier188@gmail.com');
            $user->setRoles(['ROLE_ADMIN']);
            $password = $this->hasher->hashPassword($user, 'sophie');
            $user->setPassword($password);
            $user->setLastname('Verdier');
            $user->setFirstname('Sophie');
            $user->setPseudo('sophyze');
            $user->setPhone('+33 6 25 23 26 02');
            $user->setBiography($faker->paragraph());
            $user->setIsVerified(true);
            $user->setSubscription($this->getReference('SUBSCRIPTION_' . $faker->numberBetween(11, 13)));
            $manager->persist($user);

            $user = new User();
            $user->setEmail('jbdupont67@gmail.com');
            $user->setRoles(['ROLE_ADMIN']);
            $password = $this->hasher->hashPassword($user, 'jb');
            $user->setPassword($password);
            $user->setLastname('Dupont');
            $user->setFirstname('Jean-Baptiste');
            $user->setPseudo('memory');
            $user->setPhone('+33 6 87 87 53 71');
            $user->setBiography($faker->paragraph());
            $user->setIsVerified(true);
            $user->setSubscription($this->getReference('SUBSCRIPTION_' . $faker->numberBetween(11, 13)));
            $manager->persist($user);

            $user = new User();
            $user->setEmail('buyer@gmail.com');
            $user->setRoles(['ROLE_BUYER']);
            $password = $this->hasher->hashPassword($user, 'buyer');
            $user->setPassword($password);
            $user->setLastname('Buyer');
            $user->setFirstname('Buyer');
            $user->setPseudo('buyer');
            $user->setPhone('+33 6 25 23 26 02');
            $user->setBiography($faker->paragraph());
            $user->setIsVerified(true);
            $user->setSubscription($this->getReference('SUBSCRIPTION_' . $faker->numberBetween(11, 13)));
            $manager->persist($user);

            $user = new User();
            $user->setEmail('seller@gmail.com');
            $user->setRoles(['ROLE_SELLER']);
            $password = $this->hasher->hashPassword($user, 'seller');
            $user->setPassword($password);
            $user->setLastname('Seller');
            $user->setFirstname('Seller');
            $user->setPseudo('seller');
            $user->setPhone('+33 6 25 23 26 02');
            $user->setBiography($faker->paragraph());
            $user->setIsVerified(true);
            $user->setSubscription($this->getReference('SUBSCRIPTION_' . $faker->numberBetween(11, 13)));
            $manager->persist($user);

            $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          SubscriptionFixtures::class,
        ];
    }
}
