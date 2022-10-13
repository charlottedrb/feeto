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
        $categories = ['Intérieur', 'Extérieur'];
        $interiorCategories = ['Ombre', 'Pièce lumineuse', 'Gourmande', 'Increvable'];
        $exteriorCategories = ['Printemps/Été', 'Automne/Hiver'];
        $plants = [
            'Monstera Deliciosa' => [
                'size' => 40,
                'categories' => ['Pièce lumineuse', 'Gourmande'],
                'complexity' => 2,
                'price' => 30,
                'origin' => 'Mexique',
                'description' => "The monstera deliociosa is a plant which need not much water but a lot of sunlight. But be careful, you must not put it under direct sun light, unless you won’t to burn it down.",
                'image' => 'monstera.png',
            ],
            'Philodendron' => [
                'size' => 40,
                'categories' => ['Ombre'],
                'complexity' => 4,
                'price' => 40,
                'origin' => 'Brésil',
                'description' => "The monstera deliociosa is a plant which need not much water but a lot of sunlight. But be careful, you must not put it under direct sun light, unless you won’t to burn it down.",
                'image' => 'philodendron.png',
            ],
            'Aloe Vera' => [
                'size' => 20,
                'categories' => ['Increvable', 'Pièce lumineuse'],
                'complexity' => 1,
                'price' => 15,
                'origin' => 'Indonésie',
                'description' => "The monstera deliociosa is a plant which need not much water but a lot of sunlight. But be careful, you must not put it under direct sun light, unless you won’t to burn it down.",
                'image' => 'aloe-vera.png',
            ],
        ];

        foreach ($categories as $cat) {
            $category = new Category();
            $category->setName($cat);
            $manager->persist($category);
            $this->addReference($cat, $category);
        }

        foreach ($interiorCategories as $cat) {
            $category = new Category();
            $category->setName($cat);
            $category->setParent($this->getReference('Intérieur'));
            $manager->persist($category);
            $this->addReference($cat, $category);
        }

        foreach ($exteriorCategories as $cat) {
            $category = new Category();
            $category->setName($cat);
            $category->setParent($this->getReference('Extérieur'));
            $manager->persist($category);
            $this->addReference($cat, $category);
        }
        
        foreach ($plants as $name => $plant) {
            $dbPlant = new Plant();
            $dbPlant->setName($name);
            $dbPlant->setSize($plant['size']);
            $dbPlant->setComplexity($plant['complexity']);
            $dbPlant->setPrice($plant['price']);
            $dbPlant->setOrigin($plant['origin']);
            $dbPlant->setDescription($plant['description']);
            $dbPlant->setImageUrl($plant['image']);

            foreach ($plant['categories'] as $cat) {
                $dbPlant->addCategory($this->getReference($cat));
            }
            $manager->persist($dbPlant);
        }

        $manager->flush();
    }
}