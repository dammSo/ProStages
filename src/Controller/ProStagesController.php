<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Stage;
use App\Entity\Entrepise;
use App\Entity\Formation;

class ProStagesController extends AbstractController
{
    /**
     * @Route("/", name="ProStages_acceuil")
     */
    public function index()
    {
        return $this->render('ProStages/index.html.twig', [
            'controller_name' => 'ProStagesController',
        ]);
    }
   /**
     * @Route("/entreprises", name="ProStages_entreprises")
     */
    public function page_entreprises()
    {
        return $this->render('ProStages/page_entreprises.html.twig', [
            'controller_name' => 'ProStagesController',
        ]);
    }
    /**
     * @Route("/formations", name="ProStages_formations")
     */
    public function page_formations()
    {
        return $this->render('ProStages/page_formations.html.twig', [
            'controller_name' => 'ProStagesController',
        ]);
    }
    /**
     * @Route("/stages/{id}", name="ProStages_stageAvecId")
     */
    public function page_stageAvecId($id)
    {
        $unStage = $this->getDoctrine()->getRepository(Stage::class);
        $stage = $unStage->findOneById($id);
        
        return $this->render('ProStages/page_stageAvecId.html.twig', [
            'controller_name' => 'ProStagesController', 'stage' => $stage, 'id' => $id
        ]);
    }
    
    /**
     * @Route("/detail_entreprise/{entreprise}", name="ProStages_detail_entreprise")
     */
    public function page_detail_entreprise($entreprise)
    {
        return $this->render('ProStages/page_detail_entreprise.html.twig', [
            'controller_name' => 'ProStagesController', 'entreprise' => $entreprise
        ]);
    }
}
