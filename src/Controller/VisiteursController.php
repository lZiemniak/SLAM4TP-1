<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VisiteursController extends AbstractController
{
    /**
     * @Route("/visiteurs", name="visiteurs")
     */
    public function index()
    {
        return $this->render('visiteurs/index.html.twig', [
            'controller_name' => 'VisiteursController',
        ]);
    }
}
