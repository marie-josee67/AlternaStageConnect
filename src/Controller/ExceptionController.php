<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ExceptionController extends AbstractController
{
    #[Route('/error', name: 'app_error')]
    public function error(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error.html.twig');
    }

    #[Route('/error403', name: 'app_error403')]
    public function error403(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error403.html.twig');
    }

    #[Route('/error404', name: 'app_error404')]
    public function error404(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
    }

    #[Route('/error500', name: 'app_error500')]
    public function error500(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error500.html.twig');
    }

    #[Route('/error502', name: 'app_error502')]
    public function error502(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error502.html.twig');
    }

    #[Route('/error504', name: 'app_error504')]
    public function error504(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error504.html.twig');
    }
}
