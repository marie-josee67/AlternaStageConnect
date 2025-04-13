<?php

namespace App\Controller;

use App\Entity\Postuler;
use App\Entity\Alternance;
use App\Form\PostulerType;
use App\Form\AlternanceType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * Contrôleur de la page Alternances et des pages statiques
 */
final class AlternancesController extends AbstractController
{
    /**
     * Page d'affichage de la liste complète des annonces d'alternances en base
     * 
     * @route alternances/
     * @name app_alternances
     * @methods GET
     * 
     * @param AlternanceRepository $alternanceRepository (Service) Repository permettant l'accès aux données en base
     * 
     * @return Response Réponse HTTP renvoyée au navigateur comportant la liste des alternances
     */ 
    #[Route('/alternances', name: 'app_alternances')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $alternanceRepository = $entityManager->getRepository(Alternance::class);
        $alternances = $alternanceRepository->findAll();
        return $this->render('alternances/index.html.twig', [
            'alternances' => $alternances,
        ]);
    }

    /* ********************************** creation d'une alternance ***************************************************  */
    /**
     * @route alternances/create
     * @name app_alternances_create
     * 
     * @param EntityManagerInterface $entityManager (dépendance) Gestionnaire d'entités
     * @param Request $request (dépendance) Objet contenant la requête envoyé par le navigateur ($_POST/$_GET)
     * 
     * @var UploadedFile $imageFile
     * 
     * @return Response Réponse HTTP renvoyée au navigateur comportant le formulaire de création
     * */
    #[Route('/alternances/create', name: 'app_alternances_create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        // création de l'objet
        $alternance = new Alternance();

        // création du formulaire pour l'affichage
        // @param AlternanceType : correspond à la classe du formulaire
        // @param $alternance : l'objet qui sera remplit par le formulaire
        $formAlternanceCreate = $this->createForm(AlternanceType::class,$alternance);

        // on dit au formulaire de récupérer les données de la requête ($_POST)
        $formAlternanceCreate->handleRequest($request);

        // tester si le formulaire à été soumis ou pas
        if ($formAlternanceCreate->isSubmitted() && $formAlternanceCreate->isValid()){

            $imageFile = $formAlternanceCreate->get('img')->getData();
        
            if ($imageFile) {
                $newFilename = uniqid().'.'.$imageFile->guessExtension();
        
                $imageFile->move(
                    $this->getParameter('images_directory'), 
                    $newFilename
                );

                $alternance->setImg($newFilename);
            }
        
            // associer l'utilisateur connecter à l'annonce
            $alternance->setUser($this->getUser());

            $entityManager->persist($alternance);
            $entityManager->flush();
        
            $this->addFlash(
                'success',
                "La création a bien été enregistrée"
            );
        
            return $this->redirectToRoute('app_alternances');
        
            // prépare les données à être sauvegarder en base
            $entityManager->persist($alternance);

            //enregistre les données en base et créer l'Id unique
            $entityManager->flush();
        }

        return $this->render('alternances/create.html.twig', [
            'formCreate'    => $formAlternanceCreate,
            'request'       => $request,
            'alternances'   => $alternance
        ]);
    }

    /* ********************************** détails d'une alternance ***************************************************  */
     /**
     * Page  d'affichage des détails d'une annonce d'alternance
     * 
     * @route alternance/{id}
     * @name app_alternance_show
     * 
     * @param Alternance $alternance Entité alternance correspondante à l'ID transmise dans l'URL
     *
     * @return Response Réponse HTTP renvoyée au navigateur avec les détails de la photo
     */
    #[Route('/alternances/{id<\d+>}', name: 'app_alternances_show')]
    public function show(Alternance $alternance): Response
    {
        return $this->render('alternances/show.html.twig', [
            'alternance' => $alternance,
        ]);
    }
    

    /* ********************************** modifier une alternance ***************************************************  */
    /**
     * Page  de modification des détails d'une alternance
     * 
     * @route alternance/edit/{id}
     * @name app_alternance_edit
     * 
     * @param alternance $alternance Entité Alternance correspondante à l'ID transmise dans l'URL
     * @param EntityManagerInterface $entityManager (dépendance) Gestionnaire d'entités
     * @param Request $request (dépendance) Objet contenant la requête envoyé par le navigateur ($_POST/$_GET)
     *
     * @return Response Réponse HTTP renvoyée au navigateur avec les détails de la photo
     */
    #[Route('/alternances/edit/{id<\d+>}', name: 'app_alternances_edit', methods: ['GET', 'POST'])]
    public function edit(Alternance $alternance, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création du formulaire pour l'affichage
        // @param AlternanceType : correspond à la classe du formulaire
        // @param $alternance : l'objet qui remplit par défaut le formulaire et qui sera mis à jour
        $formAlternanceEdit = $this->createForm(AlternanceType::class, $alternance);

        // On dit au formulaire de récupérer les données de la requête ($_POST)
        $formAlternanceEdit->handleRequest($request);

        // On vérifie que le formulaire a été soumis et que les données sont valides
        if($formAlternanceEdit->isSubmitted() && $formAlternanceEdit->isValid())
        {    
            // Le persist n'est pas à faire en cas de modification, les données provenant déjà la base

            // Met à jour les données en base
            $entityManager->flush();

            //message
            $this->addFlash(
                'success',
                "Les modifications ont été enregistrées"
            );
        }

        return $this->render('alternances/edit.html.twig', [
            'alternance'       => $alternance,
            'formEdit'      => $formAlternanceEdit
        ]);
    }

    /* ********************************** supprimer une alternance ***************************************************  */
    /**
     * Route de suppression d'une alternance
     * 
     * @route alternance/delete/{id}
     * @name app_alternance_delete
     * 
     * @param Alternance $alternance Entité Alternance correspondante à l'ID transmise dans l'URL
     * @param EntityManagerInterface $entityManager (dépendance) Gestionnaire d'entités
     *
     * @return Response Réponse HTTP renvoyée au navigateur
     */
    #[Route('/alternances/delete/{id<\d+>}', name: 'app_alternances_delete')]
    public function delete(Alternance $alternance, EntityManagerInterface $entityManager): Response
    {
        try {

            // prépare l'objet à la suppression
            $entityManager->remove($alternance);

            // on lance la suppression en base
            $entityManager->flush();

            // message
            $this->addFlash(
                'success',
                "La suppression a été effectuée"
            );

            return $this->redirectToRoute('app_alternances');
        }
        catch(\Exception $exc) {

            // Je prépare un flash qui s'affichera à l'écran avec le message d'erreur de l'exception
            $this->addFlash(
                'error',
                $exc->getMessage()
            );

            // Je redirige vers la page de la photo
            return $this->redirectToRoute('app_alternance_show', ['id' => $alternance->getId()], 304);
        }
    }
    /* ********************************** postuler à une alternance ***************************************************  */
     /**
     * Route pour postuler à une alternance
     * 
     * @route alternance/postuler/{id}
     * @name app_alternance_postuler
     * 
     * @param Alternance $alternance Entité Alternance correspondante à l'ID transmise dans l'URL
     * @param EntityManagerInterface $entityManager (dépendance) Gestionnaire d'entités
     * @param Request $request (dépendance) Objet contenant la requête envoyé par le navigateur ($_POST/$_GET)
     * 
     *
     * @return Response Réponse HTTP renvoyée au navigateur
     */
    #[Route('/alternance/postuler/{id<\d+>}', name: 'app_alternances_postuler')]
    public function postuler(
        Alternance $alternance,
        EntityManagerInterface $entityManager,
        Request $request,
        MailerInterface $mailer
    ): Response {

        // l'utilisateur doit être connecter sinon redirection avec message d'erreur
        $user = $this->getUser();
        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour postuler !');
            return $this->redirectToRoute('app_login'); 
        }

        if (!$alternance) {
            throw $this->createNotFoundException('Offre alternance introuvable');
        }

        $postuler = new Postuler();
        $formAlternancePostuler = $this->createForm(PostulerType::class, $postuler);
        $formAlternancePostuler->handleRequest($request);

        if ($formAlternancePostuler->isSubmitted() && $formAlternancePostuler->isValid()) {
            $postuler->setAlternance($alternance);

            $cvFile = $formAlternancePostuler->get('cv')->getData();
            $lettreMotivationFile = $formAlternancePostuler->get('lettreMotivation')->getData();

            if ($cvFile) {
                $cvFileName = uniqid() . '.' . $cvFile->guessExtension();

                try {
                    $cvFile->move(
                        $this->getParameter('cv_directory'),
                        $cvFileName
                    );
                    $postuler->setCv($cvFileName);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors de l\'enregistrement du CV');
                }
            }

            if ($lettreMotivationFile) {
                $lettreMotivationFileName = uniqid() . '.' . $lettreMotivationFile->guessExtension();

                try {
                    $lettreMotivationFile->move(
                        $this->getParameter('lettre_motivation_directory'),
                        $lettreMotivationFileName
                    );
                    $postuler->setLettreMotivation($lettreMotivationFileName);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors de l\'enregistrement de la lettre de motivation');
                }
            }

            // envoi de l'e-mail à l'entreprise
            $createur = $alternance->getUser();
            if ($createur) {
                $email = (new Email())
                    ->from($postuler->getEmail())
                    ->to($createur->getEmail())
                    ->subject('Nouvelle candidature pour votre offre : ' . $alternance->getTitre())
                    ->text(
                        "Nom : " . $postuler->getName() . "\n" .
                        "Email : " . $postuler->getEmail() . "\n" .
                        "Adresse : " . $postuler->getAdresse() . "\n" .
                        "Code postal : " . $postuler->getCodePostale() . "\n\n" .
                        "Message :\n" . $postuler->getMessage()
                    );

                // ajout des pièces jointes
                // pour le CV
                $cvPath = $this->getParameter('cv_directory') . '/' . $postuler->getCv();
                if (file_exists($cvPath)) {
                    $email->attachFromPath($cvPath, 'CV_' . $postuler->getName() . '.pdf');
                }

                // pour la lm = lettre de motivation
                $lmPath = $this->getParameter('lettre_motivation_directory') . '/' . $postuler->getLettreMotivation();
                if (file_exists($lmPath)) {
                    $email->attachFromPath($lmPath, 'Lettre_Motivation_' . $postuler->getName() . '.pdf');
                }
                // dd($email);
                // gestion des erreurs
                try {
                    $mailer->send($email);
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Erreur lors de l’envoi de l’email : ' . $e->getMessage());
                }
            }

            $entityManager->persist($postuler);
            $entityManager->flush();

            $this->addFlash('success', 'Votre candidature à l\'alternance a été envoyée !');
            return $this->redirectToRoute('app_alternances', ['id' => $alternance->getId()]);
        }

        return $this->render('alternances/postuler.html.twig', [
            'form' => $formAlternancePostuler->createView(),
            'alternance' => $alternance,
        ]);
    }
}