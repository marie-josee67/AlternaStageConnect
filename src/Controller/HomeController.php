<?php

namespace App\Controller;

use App\Repository\StageRepository;
use App\Repository\AlternanceRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * Contrôleur de la page d'accueil et des pages statiques
 */
final class HomeController extends AbstractController
{ 
    /**
    * Page d'accueil de l'application
    * Cette page sera accessible par défaut lorsque l'on arrive sur le site
    * 
    * @route /
    * @name app_home
    * 
    * @return Response Réponse HTTP renvoyée au navigateur
    */
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

    #[Route('/mailer', name:'app_mailer')]
    public function mailer(MailerInterface $mailer)
    {
        $email = (new TemplatedEmail())
            ->from('contact@alternancestageconnect.fr')
            ->to('test@hotmail.com')
            ->subject('Inscription réussie')
            ->htmlTemplate('email/index.html.twig');

        $mailer->send($email);

        return new Response(
            'Email bien envoyer'
         );
    }
}
