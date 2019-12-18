<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Stage;
use App\Entity\Entrepise;
use App\Entity\Formation;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        

        //Création d'un Faker
        $faker = \Faker\Factory::create('fr_FR');

        //Creer les formations à la main 
        // $product = new Product();
        // $manager->persist($product);

        //Creer de stableaux de formations et d'entreprise

        // a la fin
        $manager->flush();
    }
}
