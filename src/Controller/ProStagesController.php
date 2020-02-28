<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Request;


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
    public function page_ajout_entreprise(Request $request)
    {
         //Création de la ressource vierge
         $ajout = new Entreprise();
         
         //Définition de l'object manager
         $manager = $this->getDoctrine()->getManager();

         //Création de l'objet formulaire
         $formulaireAjout = $this -> createFormBuilder($ajout)
                                  -> add('nom', TextType::class)
                                  -> add('activite', TextType::class)
                                  -> add('adresse', TextType::class)
                                  -> add('site', UrlType::class)
                                  -> getForm(); 
        
        //Enregistrer après soumission,les données dans l'objet $entreprise
        $formulaireAjout->handleRequest($request);

        if($formulaireAjout->isSubmitted())
        {
            //On enregistre l'entrprise en BD
            $manager -> persist($ajout);
            $manager -> flush();

            //On redirige l'utilisateur vers la page qui liste toutes les entreprises
            return $this->redirect($this->generateUrl('ProStages_entreprises'));
        }
        
        //Creation de la vue
        $vueFormulaireAjout = $formulaireAjout -> createView();

        return $this->render('ProStages/page_ajout_entreprise.html.twig', [
            'controller_name' => 'ProStagesController', 'vueFormulaireAjout' => $vueFormulaireAjout
        ]);
    }
      /**
     * @Route("/modifierEntreprise/{id}", name="ProStages_modifierEntreprise")
     */
    public function modifierEntreprise(Request $requetteHttp, Entreprise $entreprise)
    {
        //Définition de l'object manager
         $manager = $this->getDoctrine()->getManager();
        // creation d'un objet formulaire pour saisir un stage
        $formulaireEntreprise = $this -> createFormBuilder($entreprise)
                                 -> add ('nom',TextType::class)
                                 -> add ('activite',TextType::class)
                                 -> add ('adresse',TextType::class)
                                 -> add ('site',UrlType::class)
                                 -> getForm();
        
        //Enregistrer après soumission,les données dans l'objet $entreprise
        $formulaireEntreprise -> handleRequest($requetteHttp);

        if ($formulaireEntreprise -> isSubmitted() )
        {
            // enregistrer l'entreprise en BD
            $manager -> persist($entreprise);
            $manager->flush();

            //redirection de l'utilisateur vers la page des entreprise
            return $this->redirectToRoute('ProStages_entreprises'); 
        }

        //creation de la vue
        $vueFormulaireEntreprise = $formulaireEntreprise -> createView();

        return $this->render('ProStages/page_modifier_entreprise.html.twig', [
            'controller_name' => 'ProStagesController', 'vueFormulaireEntreprise' => $vueFormulaireEntreprise
        ]);
    }
}
