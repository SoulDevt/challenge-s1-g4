<?php

namespace App\DataFixtures;

use App\Entity\MediaObject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Items;
use Faker\Factory;

class ItemFixtures extends Fixture {
    public function load(ObjectManager $manager): void {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $item = new Items();
            $item->setTitle($faker->sentence);
            $item->setDescription($faker->paragraph);
            $item->setPrice($faker->numberBetween(1, 1000));
            $manager->persist($item);
        }

        $manager->flush();
    }
}
