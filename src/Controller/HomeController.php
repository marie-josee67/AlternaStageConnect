<?php

namespace App\Controller;

use App\Repository\StageRepository;
use App\Repository\AlternanceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(AlternanceRepository $alternanceRepository, StageRepository $stageRepository): Response
    {
        //récupération de toute les annonces des alternances et des stage
        $alternances = $alternanceRepository->findAll();
        $stages = $stageRepository->findAll();

        // mélanger pour avoir des cards d'annonce aléatoire
        shuffle($alternances);
        shuffle($stages);

        // 8 éléments aléatoires par catégorie
        $selectedAlternances = array_slice($alternances, 0, 8);
        $selectedStages = array_slice($stages, 0, 8);

        return $this->render('home/index.html.twig', [
            'alternances' => $selectedAlternances,
            'stages' => $selectedStages,
        ]);
    }
}
