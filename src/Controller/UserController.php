<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class UserController extends AbstractController
{
    /**
     * Page d'affichage de la liste complète des utilisateurs
     * 
     * @route user/
     * @name app_user
     * @methods GET
     * 
     * @param StageRepository $stageRepository (Service) Repository permettant l'accès aux données en base
     * 
     * @return Response Réponse HTTP renvoyée au navigateur comportant la liste des stages
     */ 
    #[Route('/user', name: 'app_user')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /* ********************************** supprimer un utilisateur ***************************************************  */
    /**
     * Route de suppression d'un utilisateur
     * 
     * @route user/delete/{id}
     * @name app_user_delete
     * 
     * @param SUser Entité User correspondante à l'ID transmise dans l'URL
     * @param EntityManagerInterface $entityManager (dépendance) Gestionnaire d'entités
     *
     * @return Response Réponse HTTP renvoyée au navigateur
     */
    #[Route('/user/delete/{id<\d+>}', name: 'app_user_delete')]
    public function delete(User $user, EntityManagerInterface $entityManager): Response
    {
        try {

            // prépare l'objet à la suppression
            $entityManager->remove($user);

            // on lance la suppression en base
            $entityManager->flush();

            // si tout s'est bien passé, je redirige vers la liste
            $this->addFlash(
                'success',
                "La suppression a été effectuée"
            );

            return $this->redirectToRoute('app_stages');
        }
        catch(\Exception $exc) {

            // Je prépare un flash qui s'affichera à l'écran avec le message d'erreur de l'exception
            $this->addFlash(
                'error',
                $exc->getMessage()
            );
        } finally{
            return $this->redirectToRoute('app_user');
        }

    }
}
