<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker\Factory;

class UserFixtures extends Fixture {
    public function load(ObjectManager $manager): void {
        $faker = Factory::create('fr_FR');
        $admin = new User();
        $admin->setEmail('admin@example.com');
        $admin->setPassword('$2y$13$.uXrIuqBP3B9QmxrSWD0D.OirD8A/4/F1RtkjlOLYIRlzbXtKkq7O'); // admin
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setName($faker->userName);
        $admin->setFirstName($faker->firstName);
        $admin->setLastName($faker->lastName);
        $admin->setPostalAddress($faker->address);
        $admin->setPostalCode(intval($faker->postcode));
        $admin->setPhoneNumber($faker->phoneNumber);
        $manager->persist($admin);

        $user = new User();
        $user->setEmail('user@example.com');
        $user->setPassword('$2y$13$boNxQUuLg8br5QWTQy0GOedhRtWb0QVT76/wvklL8m1ntXj7R2ynC'); // user
        $user->setRoles(['ROLE_USER']);
        $user->setName($faker->userName);
        $user->setFirstName($faker->firstName);
        $user->setLastName($faker->lastName);
        $user->setPostalAddress($faker->address);
        $user->setPostalCode(intval($faker->postcode));
        $user->setPhoneNumber($faker->phoneNumber);
        $manager->persist($user);

        $manager->flush();
    }
}
