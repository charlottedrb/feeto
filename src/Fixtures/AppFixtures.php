<?php
// src/Fixtures/AppFixtures.php
namespace App\Fixtures;

use App\Entity\User;
use App\Entity\Plant;
use App\Entity\Review;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->passwordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $users = [
            'admin' => [
                'email' => 'test@admin.fr',
                'first_name' => 'Admin',
                'last_name' => 'Feeto',
                'password' => 'feeto2',
                'title' => 'Jardinier confirmé',
            ],
            'charlottedb' => [
                'email' => 'c.derbaghdassarian@gmail.com',
                'first_name' => 'Charlotte',
                'last_name' => 'Der Baghdassarian',
                'password' => 'charlotte',
                'title' => 'Jardinier/ère débutant(e)',
            ]
        ];
        $reviews = [
            [
                'title' => 'I love this plant',
                'content' => 'Bought it two months ago and it grows so much ! Very graphic and so beautiful ! Be aware if you have animals like cats, they will destroy it. Place it in a place where they can\'t go.',
                'user' => 'charlottedb',
                'plant' => 'Monstera Deliciosa',
            ],
            [
                'title' => 'I love this plant',
                'content' => 'Bought it two months ago and it grows so much ! Very graphic and so beautiful ! Be aware if you have animals like cats, they will destroy it. Place it in a place where they can\'t go.',
                'user' => 'charlottedb',
                'plant' => 'Philodendron',
            ],
        ];
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

        foreach ($users as $username => $user) {
            $dbUser = new User();
            $dbUser->setUsername($username);
            $dbUser->setTitle($user['title']);
            $dbUser->setEmail($user['email']);
            $dbUser->setFirstName($user['first_name']);
            $dbUser->setLastName($user['last_name']);
            $dbUser->setPassword($user['password']);
            $dbUser->setPassword(
                $this->passwordHasher->hashPassword(
                    $dbUser,
                    $user['password']
                )
            );
            $dbUser->setRoles(['ROLE_ADMIN']);
            $dbUser->addRole('ROLE_ADMIN');
            $manager->persist($dbUser);
            $this->addReference($username, $dbUser);
        }

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
            $this->addReference($name, $dbPlant);
        }

        foreach ($reviews as $review) {
            $dbReview = new Review();
            $dbReview->setTitle($review['title']);
            $dbReview->setContent($review['content']);
            $dbReview->setUser($this->getReference($review['user']));
            $dbReview->setPlant($this->getReference($review['plant']));
            $dbReview->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($dbReview);
        }

        $manager->flush();
    }
}
