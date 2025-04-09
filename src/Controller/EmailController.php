<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class EmailController extends AbstractController
{
    #[Route('/email', name: 'app_email')]
    public function index(MailerInterface $mailer): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        
    
        if (!$user) {
            throw $this->createAccessDeniedException('Aucun utilisateur connecté');
        }
    
        $nomUtilisateur = $user->getFirstname();
        $emailUtilisateur = $user->getEmail();
    
        $email = (new TemplatedEmail())
            ->from('contact@alternancestageconnect.fr')
            ->to($emailUtilisateur)
            ->subject('Inscription réussie')
            ->htmlTemplate('email/index.html.twig')
            ->context([
                'name' => $nomUtilisateur
            ]);
    
        $mailer->send($email);
        
        return $this->render('email/index.html.twig', [
            'controller_name' => 'EmailController',
        ]);
    }
}
