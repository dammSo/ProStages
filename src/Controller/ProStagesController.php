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
         $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

         //Recuperation des ressource en BD
         $listeStages = $repositoryStage->findAll();
    
         //Tri de la liste récupéré
         



        return $this->render('ProStages/page_entreprises.html.twig', [
            'controller_name' => 'ProStagesController', 'listeStages' => $listeStages
        ]);
    }
    /**
     * @Route("/formations", name="ProStages_formations")
     */
    public function page_formations()
    {
        
         //Recuperer le repository
         $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

         //Recuperation des ressource en BD
         $listeStages = $repositoryStage->findALL();

         //Tri de la liste récupérée
         
        

         return $this->render('ProStages/page_formations.html.twig', [
            'controller_name' => 'ProStagesController', 'listeStages' => $listeStages
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
}
