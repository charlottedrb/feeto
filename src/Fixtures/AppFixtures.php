<?php
// src/Fixtures/AppFixtures.php
namespace App\Fixtures;

use App\Entity\Plant;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = [];
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setName('category '.$i);
            $manager->persist($category);
            $categories[] = $category;
        }

        for ($i = 0; $i < 10; $i++) {
            $plant = new Plant();
            $plant->setName('plant '.$i);
            $plant->setSize(mt_rand(1, 10));
            $plant->setComplexity(mt_rand(1, 5));
            $plant->setPrice(mt_rand(10, 100));
            $plant->setOrigin('Europe');
            $plant->setDescription('This is a fake plant here.');
            $plant->setImageUrl('images/fake_plant.jpeg');
            $plant->addCategory($categories[$i]);
            $manager->persist($plant);
        }

        $manager->flush();
    }
}