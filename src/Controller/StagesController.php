<?php

namespace App\Controller;

use App\Entity\Stage;
use App\Form\StageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class StagesController extends AbstractController
{
    #[Route('/stages', name: 'app_stages')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $stageRepository = $entityManager->getRepository(Stage::class);
        $stages = $stageRepository->findAll();
        return $this->render('stages/index.html.twig', [
            'stages' => $stages,
        ]);
    }

    /* ********************************** creation d'un stage ***************************************************  */
    #[Route('/stages/create', name: 'app_stages_create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        // création de l'objet
        $stage = new Stage();

        // création du formulaire pour l'affichage
        // @param StageType : correspond à la classe du formulaire
        // @param $stage : l'objet qui sera remplit par le formulaire
        $formStageCreate = $this->createForm(StageType::class,$stage);

        // on dit au formulaire de récupérer les données de la requête ($_POST)
        $formStageCreate->handleRequest($request);

        // tester si le formulaire à été soumis ou pas
        if ($formStageCreate->isSubmitted() && $formStageCreate->isValid()){
            
            // prépare les données à être sauvegarder en base
            $entityManager->persist($stage);

            //enregistre les données en base et créer l'Id unique
            $entityManager->flush();
        }

        return $this->render('stages/create.html.twig', [
            'formCreate' => $formStageCreate,
            'request' => $request,
            'alternances'=>$stage
        ]);
    }
}
