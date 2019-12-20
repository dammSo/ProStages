<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;

class ProStagesController extends AbstractController
{
    
    /**
     * @Route("/", name="ProStages_acceuil")
     */
    public function index()
    {
        //Recuperer le repository
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        //Recuperation des ressource en BD
        $listeStages = $repositoryStage->findAll();
        
        //Envoi des données à la vue
        return $this->render('ProStages/index.html.twig', [
            'controller_name' => 'ProStagesController', 'listeStages' => $listeStages
        ]);
    }
   /**
     * @Route("/entreprises", name="ProStages_entreprises")
     */
    public function page_entreprises()
    {
         //Recuperer le repository
         $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);

         //Recuperation des ressource en BD
         $listeEntreprises = $repositoryEntreprise->findAll();

        return $this->render('ProStages/page_entreprises.html.twig', [
            'controller_name' => 'ProStagesController', 'listeEntreprise' => $listeEntreprises
        ]);
    }
    /**
     * @Route("/formations", name="ProStages_formations")
     */
    public function page_formations()
    {
        
         //Recuperer le repository
         $repositoryFormation = $this->getDoctrine()->getRepository(Formation::class);

         //Recuperation des ressource en BD
         $listeFormation = $repositoryFormation->findALL();
         

         return $this->render('ProStages/page_formations.html.twig', [
            'controller_name' => 'ProStagesController', 'listeFormation' => $listeFormation
        ]);
    }
    /**
     * @Route("/stages/{id}", name="ProStages_stageAvecId")
     */
    public function page_stageAvecId($id)
    {
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);
        $stage = $repositoryStage->findOneById($id);
        
        return $this->render('ProStages/page_stageAvecId.html.twig', [
            'controller_name' => 'ProStagesController', 'stage' => $stage, 'id' => $id
        ]);
    }
    
    /**
     * @Route("/detail_entreprise/{entreprise}", name="ProStages_detail_entreprise")
     */
    public function page_detail_entreprise($entreprise)
    {
         //Recuperer le repository
         $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);

         //Recuperation des ressource en BD
         $listeEntreprises = $repositoryEntreprise->findOneByNom($entreprise);

        return $this->render('ProStages/page_detail_entreprise.html.twig', [
            'controller_name' => 'ProStagesController', 'entreprise' => $listeEntreprises
        ]);
    }
    /**
     * @Route("/stagesParFormation/{idFormation}", name="ProStages_stageParFormation")
     */
    public function page_stageParFormation($idFormation)
    {
        
        //Recuperer le repository
        $repositoryFormation = $this->getDoctrine()->getRepository(Formation::class);

        //Recuperation des ressource en BD
        $formation = $repositoryFormation->findOneById($idFormation);
        $listeStages = $formation->getStages();
     

         return $this->render('ProStages/page_stageParFormation.html.twig', [
            'controller_name' => 'ProStagesController', 'listeStages' => $listeStages
        ]);
    }
     /**
     * @Route("/stagesParEntreprise/{idEntreprise}", name="ProStages_stagesParEntreprise")
     */
    public function page_stagesParEntreprise($idEntreprise)
    {
        
        //Recuperer le repository
        $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);

        //Recuperation des ressource en BD
        $entreprise = $repositoryEntreprise->findOneById($idEntreprise);
        $listeStages = $entreprise->getStages();
     

         return $this->render('ProStages/page_stageParEntreprise.html.twig', [
            'controller_name' => 'ProStagesController', 'listeStages' => $listeStages
        ]);
    }
}
