<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Contrôleur de la page de mentions légales
 */
final class MentionsLegalesController extends AbstractController
{
    #[Route('/mentions/legales', name: 'app_mentions_legales')]
    public function index(): Response
    {
        return $this->render('mentions_legales/index.html.twig', [
            'controller_name' => 'MentionsLegalesController',
        ]);
    }
}
