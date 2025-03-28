<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AlternancesController extends AbstractController
{
    #[Route('/alternances', name: 'app_alternances')]
    public function index(): Response
    {
        return $this->render('alternances/index.html.twig', [
            'controller_name' => 'AlternancesController',
        ]);
    }
}
