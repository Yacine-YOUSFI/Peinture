<?php

  namespace App\DataFixtures;

  use App\Entity\User;
  use App\Entity\BlogPost;
  use App\Entity\Categorie;
  use App\Entity\Peinture;


  use Doctrine\Bundle\FixturesBundle\Fixture;
  use Doctrine\Persistence\ObjectManager;
  use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
  use Faker\Factory;

 class AppFixtures extends Fixture
 {
    public function __construct(UserPasswordEncoderInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager){

        $faker = Factory::create('fr_FR');
           // on crée 4 auteurs avec noms et prénoms "aléatoires" en français
           $auteurs = Array();
           for ($i = 0; $i < 4; $i++) {
               $auteurs[$i] = new User();
               $auteurs[$i]->setNom($faker->lastName());
               $auteurs[$i]->setPrenom($faker->firstName());
               $auteurs[$i]->setEmail($faker->email());
               $auteurs[$i]->setTelephone($faker->phoneNumber());
               $auteurs[$i]->setAPropos($faker->text());
               $auteurs[$i]->setInstagramm("instagram");
               $password = $this->hasher->encodePassword($auteurs[$i], 'password');
               $auteurs[$i]->setPassword($password);               

               $manager->persist($auteurs[$i]);
           }

           $blogs = Array();
           for ($i = 0; $i < 4; $i++) {
               $blogs[$i] = new BlogPost();
               $blogs[$i]->setTitre($faker->words(3, true));
               $blogs[$i]->setContenu($faker->text());
               $blogs[$i]->setSlug($faker->slug(3));
               $blogs[$i]->setDate($faker->dateTimeBetween('-30 days', 'now'));
               $blogs[$i]->setUser($auteurs[$i]);
               $manager->persist($blogs[$i]);
           }

           
           $categories = Array();
           for ($i = 0; $i < 5; $i++) {
               $categories[$i] = new Categorie();
               $categories[$i]->setNom($faker->words(3, true));
               $categories[$i]->setDescription($faker->text());
               $categories[$i]->setSlug($faker->slug(3));
               $manager->persist($categories[$i]);
           
            $peintures = Array();
            for ($j = 0; $j < 2; $j++) {
               $peintures[$j] = new Peinture();
               $peintures[$j]->setNom($faker->words(3, true));
               $peintures[$j]->setLargeur($faker->randomFloat(2, 20, 60));
               $peintures[$j]->setHaut($faker->randomFloat(2, 20, 60));
               $peintures[$j]->setDescription($faker->text());
               $peintures[$j]->setPortfolio($faker->randomElement([true, false]));
               $peintures[$j]->setEnVente($faker->randomElement([true, false]));
               $peintures[$j]->setPrix($faker->randomFloat(2, 20, 60));
               $peintures[$j]->setDatePublication($faker->dateTimeBetween('-30 days', 'now'));
               $peintures[$j]->setDateRealisation($faker->dateTimeBetween('-30 days', 'now'));
               $peintures[$j]->setSlug($faker->slug(3));
               $peintures[$j]->setFile('tt.jpg');
               $peintures[$j]->addCategorie($categories[$i]);
               $peintures[$j]->setUser($auteurs[$j]);
               $manager->persist($peintures[$j]);
           }
        }

           $manager->flush();
       }
    }