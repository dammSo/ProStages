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
        $listeStages = $repositoryStage->fetchStageEtEntreprise();
        
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
         $listeEntreprises = $repositoryEntreprise->findALL();

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
     * @Route("/stagesParEntreprise/{nomEntreprise}", name="ProStages_stagesParEntreprise")
     */
    public function page_stagesParEntreprise($nomEntreprise)
    {
        
        //Recuperer le repository
        $repositoryStagesParEntreprise = $this->getDoctrine()->getRepository(Stage::class);
        
        //Recuperation des ressource en BD
        $listeStages = $repositoryStagesParEntreprise->fetchByEntreprise($nomEntreprise);
        
         return $this->render('ProStages/page_stageParEntreprise.html.twig', [
            'controller_name' => 'ProStagesController', 'listeStages' => $listeStages
        ]);
    }
     /**
     * @Route("/stagesParFormation/{nomFormation}", name="ProStages_stageParFormation")
     */
    public function page_stagesParFormation($nomFormation)
    {
        
        //Recuperer le repository
        $repositoryStagesParFormation = $this->getDoctrine()->getRepository(Stage::class);
        
        //Recuperation des ressource en BD
        $listeStages = $repositoryStagesParFormation->fetchByFormation($nomFormation);
        
         return $this->render('ProStages/page_stageParFormation.html.twig', [
            'controller_name' => 'ProStagesController', 'listeStages' => $listeStages
        ]);
    }
    /**
     * @Route("/ajoutEntreprise", name="ProStages_ajoutEntreprise")
     */
    public function page_ajout_entreprise()
    {
         //Création de la ressource vierge
         $ajout = new Entreprise();

         //Création de l'objet formulaire
         $formulaireAjout = $this -> createFormBuilder($ajout)
                                  -> add('id')
                                  -> add('nom')
                                  -> add('activite')
                                  -> add('adresse')
                                  -> add('site')
                                  -> getForm(); 
        
        //Creation de la vue
        $vueFormulaireAjout = $formulaireAjout -> createView();

        return $this->render('ProStages/page_ajout_entreprise.html.twig', [
            'controller_name' => 'ProStagesController', 'vueFormulaireAjout' => $vueFormulaireAjout
        ]);
    }
}
