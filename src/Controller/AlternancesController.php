<?php

namespace App\Controller;

use App\Entity\Alternance;
use App\Form\AlternanceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AlternancesController extends AbstractController
{
    #[Route('/alternances', name: 'app_alternances')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $alternanceRepository = $entityManager->getRepository(Alternance::class);
        $alternances = $alternanceRepository->findAll();
        return $this->render('alternances/index.html.twig', [
            'alternances' => $alternances,
        ]);
    }
    #[Route('/alternances/create', name: 'app_alternances_create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        // création de l'objet
        $alternance = new Alternance();

        // création du formulaire pour l'affichage
        // @param AnnonceType : correspond à la classe du formulaire
        // @param $annonce : l'objet qui sera remplit par le formulaire
        $formAlternanceCreate = $this->createForm(AlternanceType::class,$alternance);

        // on dit au formulaire de récupérer les données de la requête ($_POST)
        $formAlternanceCreate->handleRequest($request);

        // tester si le formulaire à été soumis ou pas
        if ($formAlternanceCreate->isSubmitted() && $formAlternanceCreate->isValid()){
            
            // prépare les données à être sauvegarder en base
            $entityManager->persist($alternance);

            //enregistre les données en base et créer l'Id unique
            $entityManager->flush();
        }

        return $this->render('alternances/create.html.twig', [
            'formCreate' => $formAlternanceCreate,
            'request' => $request,
            'alternances'=>$alternance
        ]);
    }
}
