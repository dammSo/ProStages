<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
        return $this->render('ProStages/page_stageAvecId.html.twig', [
            'controller_name' => 'ProStagesController', 'id' => $id
        ]);
    }

}
