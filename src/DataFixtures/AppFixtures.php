<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        

        //Création d'un Faker
        $faker = \Faker\Factory::create('fr_FR');

        //Creation des formations
        $DUT_Info = new Formation();
        $DUT_Info->setLibelle('DUT Info');
        $DUT_Info->setNomComplet('Diplôme Universitaire Technologique Informatique');

        $DUT_TC = new Formation();
        $DUT_TC->setLibelle('DUT TC');
        $DUT_TC->setNomComplet('Diplôme Universitaire Technologique des Techniques de Commercialisation');

        $LP_Prog = new Formation();
        $LP_Prog->setLibelle('LP Prog Avancée');
        $LP_Prog->setNomComplet('Licence Professionnelle en Programmation Avancée');
        
        $listeFormations = array($DUT_Info,$DUT_TC,$LP_Prog);

        $manager->persist($DUT_Info);
        $manager->persist($DUT_TC);
        $manager->persist($LP_Prog);

        //Creation des entreprises 
        
        $listeEntreprises = array();
        $nbEntreprises = $faker->numberBetween(8,12);

        for($i=0 ;$i<$nbEntreprises;$i++)
        {
            $entreprise = new Entreprise();
            $entreprise->setNom($faker->company);
            $entreprise->setActivite($faker->catchphrase);
            $entreprise->setAdresse($faker->address);
            $entreprise->setSite($faker->url);
            $listeEntreprises[] = $entreprise;
            $manager->persist($entreprise);
        }

        //Creation des stages

        $nbStages = $faker->numberBetween(25,35);

        for($i=0 ;$i<$nbStages ;$i++)
        {
            //Definition du stage
            $stage = new Stage();
            $stage->setTitre($faker->jobTitle);
            $stage->setDescription($faker->text($maxNbChars = 255));
            $stage->setMail($faker->safeEmail);
            
            //Attribution d'une entreprise 
            $numEntreprise = $faker->numberBetween(0,$nbEntreprises-1);
            $listeEntreprises[$numEntreprise]->addStage($stage);

            //Attribution d'une ou deux formations
            $nbFormation = $faker->numberBetween(1,2);
            $formationSelectionee = $faker->randomElements($array = $listeFormations , $count = $nbFormation);
            foreach ($formationSelectionee as $value)
            {
                $value->addStage($stage);
            }
            
            $manager->persist($stage);
        }
        $manager->flush();
    }
}
