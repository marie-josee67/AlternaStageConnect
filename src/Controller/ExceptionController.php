<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * contrôleur des pages liées aux exceptions et erreurs
 * permet de le débug des vues également
 */
final class ExceptionController extends AbstractController
{
    /**
     * Page d'erreur par défaut
     * Cette vue sera appelée (en production) lorsqu'une erreur se produira 
     * (autre que les erreurs spécifiquement définies plus bas dans ce contrôleur)
     * 
     * @route error
     * @name app_error
     * 
     * @return Response Réponse HTTP renvoyée au navigateur
     */
    #[Route('/error', name: 'app_error')]
    public function error(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error.html.twig');
    }

    /**
     * Page d'erreur spécifique pour l'erreur HTTP 403
     * 
     * @route error403
     * @name app_error403
     * 
     * @return Response Réponse HTTP renvoyée au navigateur
     */
    #[Route('/error403', name: 'app_error403')]
    public function error403(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error403.html.twig');
    }

    /**
     * Page d'erreur spécifique pour l'erreur HTTP 404
     * 
     * @route error404
     * @name app_error404
     * 
     * @return Response Réponse HTTP renvoyée au navigateur
     */
    #[Route('/error404', name: 'app_error404')]
    public function error404(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
    }

    /**
     * Page d'erreur spécifique pour l'erreur HTTP 500
     * 
     * @route error500
     * @name app_error500
     * 
     * @return Response Réponse HTTP renvoyée au navigateur
     */
    #[Route('/error500', name: 'app_error500')]
    public function error500(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error500.html.twig');
    }

    /**
     * Page d'erreur spécifique pour l'erreur HTTP 502
     * 
     * @route error502
     * @name app_error502
     * 
     * @return Response Réponse HTTP renvoyée au navigateur
     */
    #[Route('/error502', name: 'app_error502')]
    public function error502(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error502.html.twig');
    }

    /**
     * Page d'erreur spécifique pour l'erreur HTTP 504
     * 
     * @route error504
     * @name app_error504
     * 
     * @return Response Réponse HTTP renvoyée au navigateur
     */
    #[Route('/error504', name: 'app_error504')]
    public function error504(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error504.html.twig');
    }
}
