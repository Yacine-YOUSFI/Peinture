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
           }
            $peintures = Array();
            for ($i = 0; $i < 2; $i++) {
               $peintures[$i] = new Peinture();
               $peintures[$i]->setNom($faker->words(3, true));
               $peintures[$i]->setLargeur($faker->randomFloat(2, 20, 60));
               $peintures[$i]->setHaut($faker->randomFloat(2, 20, 60));
               $peintures[$i]->setDescription($faker->text());
               $peintures[$i]->setPortfolio($faker->randomElement([true, false]));
               $peintures[$i]->setEnVente($faker->randomElement([true, false]));
               $peintures[$i]->setPrix($faker->randomFloat(2, 20, 60));
               $peintures[$i]->setDatePublication($faker->dateTimeBetween('-30 days', 'now'));
               $peintures[$i]->setDateRealisation($faker->dateTimeBetween('-30 days', 'now'));
               $peintures[$i]->setSlug($faker->slug(3));
               $peintures[$i]->addCategorie($categories[$i]);
               $peintures[$i]->setUser($auteurs[$i]);
               $manager->persist($peintures[$i]);
           }

           $manager->flush();
       }
    }