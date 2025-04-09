<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Contrôleur de la page a propos et des pages statiques
 */
final class AproposController extends AbstractController
{ 
    /**
    * Page a propos de l'application
    * 
    * @route /
    * @name app_apropos
    * 
    * @return Response Réponse HTTP renvoyée au navigateur
    */
    #[Route('/apropos', name: 'app_apropos')]
    public function index(): Response
    {
        return $this->render('apropos/index.html.twig', [
            'controller_name' => 'AproposController',
        ]);
    }
}
