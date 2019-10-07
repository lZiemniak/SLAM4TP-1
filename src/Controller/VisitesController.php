<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VisitesController extends AbstractController
{
    /**
     * @Route("/visites", name="visites")
     */
    public function index()
    {
        return $this->render('visites/index.html.twig', [
            'controller_name' => 'VisitesController',
        ]);
    }
}
