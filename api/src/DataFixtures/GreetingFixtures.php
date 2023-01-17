<?php

namespace App\DataFixtures;

use App\Entity\Greeting;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class GreetingFixtures extends Fixture
{

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $greeting = new Greeting();
            $greeting->setName($faker->name);
            $manager->persist($greeting);
        }
        $manager->flush();
    }
}
