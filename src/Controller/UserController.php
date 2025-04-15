<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


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
        // récupère tous les id des utilisateurs, mais par ordre décroissant
        $users = $userRepository->findBy([], ['id' => 'DESC']);

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
     * @param User Entité User correspondante à l'ID transmise dans l'URL
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
    /* ********************************** Profil utilisateur ***************************************************  */
    /**
     * Route profil d'un utilisateur
     * 
     * @route user/profil
     * @name app_user_profil
     * 
     * @param User Entité User correspondante à l'ID transmise dans l'URL
     * @param EntityManagerInterface $entityManager (dépendance) Gestionnaire d'entités
     *
     * @return Response Réponse HTTP renvoyée au navigateur
     */
    #[Route('/user/profil', name: 'app_user_profil')]
    public function profile(): Response
    {
        // utilisateur connecter
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException("Vous devez être connecté pour accéder à votre profil.");
        }

        // Afficher un message de succès
        $this->addFlash('success', 'Votre compte à bien été créer !');
        return $this->render('user/profil.html.twig', [
            'user' => $user,
        ]);
    }

    /* ********************************** Éditer le profil utilisateur ***************************************************  */
    /**
     * Route edit profil d'un utilisateur
     * 
     * @route user/edit
     * @name app_user_edit
     * 
     * @param User Entité User correspondante à l'ID transmise dans l'URL
     * @param EntityManagerInterface $entityManager (dépendance) Gestionnaire d'entités
     *
     * @return Response Réponse HTTP renvoyée au navigateur
     */
    #[Route('/user/edit', name: 'app_user_edit')]
    #[IsGranted('USER_UPDATE', subject: 'user', message:" Droit insufffisants ! ")]
    public function editProfile(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = $this->getUser();
    
        if (!$user instanceof PasswordAuthenticatedUserInterface) {
            throw new AccessDeniedException('Utilisateur non connecté ou type invalide.');
        }
    
        // Créer et traiter le formulaire
        $formProfilEdit = $this->createForm(UserType::class, $user);
        $formProfilEdit->handleRequest($request);
    
        // Si le formulaire est soumis et valide
        if ($formProfilEdit->isSubmitted() && $formProfilEdit->isValid()) {
    
            // Récupérer le mot de passe en clair et sa confirmation
            $plainPassword = $formProfilEdit->get('plainPassword')->getData();
            $confirmPassword = $formProfilEdit->get('confirmPassword')->getData();
    
            // vérification du changement de mot de passe ou non
            if ($plainPassword && $plainPassword !== $confirmPassword) {
                $formProfilEdit->get('confirmPassword')->addError(new FormError('Les mots de passe ne correspondent pas.'));
            } else {
                if ($plainPassword) {
                    $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
                    /** @var \App\Entity\User $user */
                    $user->setPassword($hashedPassword);
                }
    
                $entityManager->flush();
                $this->addFlash('success', 'Profil mis à jour !');
    
                return $this->redirectToRoute('app_user_profil');
            }
        }
    
        return $this->render('user/edit.html.twig', [
            'formProfilEdit' => $formProfilEdit->createView(),
        ]);
    }


    /* ********************************** Supprimer le profil utilisateur ***************************************************  */
    /**
     * Route supprimer le profil d'un utilisateur et le déconnecter automatiquement
     * 
     * @route user/delete
     * @name app_user_delete
     * 
     * @param User Entité User correspondante à l'ID transmise dans l'URL
     * @param EntityManagerInterface $entityManager (dépendance) Gestionnaire d'entités
     *
     * @return Response Réponse HTTP renvoyée au navigateur
     */
    #[Route('/user/delete', name: 'app_user_delete')]
    #[IsGranted('USER_DELETE', subject: 'user', message:" Droit insufffisants ! ")]
    public function deleteMyself(
        EntityManagerInterface $entityManager,
        TokenStorageInterface $tokenStorage,
        Request $request
    ): Response {
        $user = $this->getUser();
    
        $entityManager->remove($user);
        $entityManager->flush();
    
        // Déconnecter l'utilisateur
        $tokenStorage->setToken(null);
        $request->getSession()->invalidate();

        // Afficher un message de succès
        $this->addFlash('success', 'Votre profil à bien été supprimer!');
        return $this->redirectToRoute('app_home');
    }

    
    /* ********************************** Modification des rôles utilisateurs ***************************************************  */
    /**
     * Route modification des rôles utilisateurs
     * 
     * @route user/delete
     * @name app_user_delete
     * 
     * @param User Entité User correspondante à l'ID transmise dans l'URL
     * @param EntityManagerInterface $entityManager (dépendance) Gestionnaire d'entités
     *
     * @return Response Réponse HTTP renvoyée au navigateur
     */
    #[Route('/user/roles/{id<\d+>}', name: 'app_user_roles')]
    public function setRoles(User $user, EntityManagerInterface $entityManager, Request $request): Response 
    {
        // dd($request->request);
        $roles=[];
        if($request->request->get('user-role-modal-'.$user->getId().'-modo'))
        {
            $roles[] = 'ROLE_MODO';
        }

        if($request->request->get('user-role-modal-'.$user->getId().'-admin'))
        {
            $roles[] = 'ROLE_ADMIN';
        }

        if($request->request->get('user-role-modal-'.$user->getId().'-super'))
        {
            $roles[] = 'ROLE_SUPERADMIN';
        }

        //mettre à jour le rôle de l'utilisateur
        $user->setRoles($roles);
        $entityManager->flush();

        return $this->redirectToRoute('app_user');
    }
}
