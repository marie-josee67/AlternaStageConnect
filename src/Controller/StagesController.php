<?php

namespace App\Controller;

use App\Entity\Stage;
use App\Form\StageType;
use App\Entity\Postuler;
use App\Form\PostulerType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

final class StagesController extends AbstractController
{
    /**
     * Page d'affichage de la liste complète des stages en base
     * 
     * @route stages/
     * @name app_stages
     * @methods GET
     * 
     * @param StageRepository $stageRepository (Service) Repository permettant l'accès aux données en base
     * 
     * @return Response Réponse HTTP renvoyée au navigateur comportant la liste des stages
     */ 
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
    /**
     * @route stages/create
     * @name app_stages_create
     * 
     * @param EntityManagerInterface $entityManager (dépendance) Gestionnaire d'entités
     * @param Request $request (dépendance) Objet contenant la requête envoyé par le navigateur ($_POST/$_GET)
     * 
     * @return Response Réponse HTTP renvoyée au navigateur comportant le formulaire de création
     * */
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

            // gestion de l'image uploadée
            /** @var UploadedFile $imageFile */
            $imageFile = $formStageCreate->get('img')->getData();
        
            if ($imageFile) {
                $newFilename = uniqid().'.'.$imageFile->guessExtension();
        
                // déplace le fichier vers le répertoire public/uploads/images
                $imageFile->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );
        
                // enregistre le nom du fichier dans l'entité
                $stage->setImg($newFilename);
            }
        
            // Associer l'utilisateur connecté à l'alternance
            $stage->setUser($this->getUser());
            
           //prépare les données à être sauvegarder en base
           $entityManager->persist($stage);

           //enregistre les données en base et créer l'Id unique
           $entityManager->flush();
        
            $this->addFlash(
                'success',
                "La création a bien été enregistrée"
            );
        
            return $this->redirectToRoute('app_stages'); 
        }

        // message
        $this->addFlash(
            'success',
            "La création a bien été enregistrées"
        );

        return $this->render('stages/create.html.twig', [
            'formCreate' => $formStageCreate,
            'request' => $request,
            'stages'=>$stage
        ]);
    }
    /* ********************************** détails d'une stage ***************************************************  */
     /**
     * Page  d'affichage des détails d'une annonce d'stage
     * 
     * @route stage/{id}
     * @name app_stage_show
     * 
     * @param Stage $stage Entité stage correspondante à l'ID transmise dans l'URL
     *
     * @return Response Réponse HTTP renvoyée au navigateur avec les détails de la photo
     */
    #[Route('/stages/{id<\d+>}', name: 'app_stages_show')]
    public function show(Stage $stage): Response
    {
        return $this->render('stages/show.html.twig', [
            'stage' => $stage,
        ]);
    }
    

    /* ********************************** modifier une stage ***************************************************  */
    /**
     * Page  de modification des détails d'une stage
     * 
     * @route stage/edit/{id}
     * @name app_stage_edit
     * 
     * @param stage $stage Entité Stage correspondante à l'ID transmise dans l'URL
     * @param EntityManagerInterface $entityManager (dépendance) Gestionnaire d'entités
     * @param Request $request (dépendance) Objet contenant la requête envoyé par le navigateur ($_POST/$_GET)
     *
     * @return Response Réponse HTTP renvoyée au navigateur avec les détails de la photo
     */
    #[Route('/stages/edit/{id<\d+>}', name: 'app_stages_edit', methods: ['GET', 'POST'])]
    public function edit(Stage $stage, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création du formulaire pour l'affichage
        // @param StageType : correspond à la classe du formulaire
        // @param $stage : l'objet qui remplit par défaut le formulaire et qui sera mis à jour
        $formStageEdit = $this->createForm(StageType::class, $stage);

        // On dit au formulaire de récupérer les données de la requête ($_POST)
        $formStageEdit->handleRequest($request);

        // On vérifie que le formulaire a été soumis et que les données sont valides
        if($formStageEdit->isSubmitted() && $formStageEdit->isValid())
        {    
            // Gestion de la nouvelle image uploadée
            $imageFile = $formStageEdit->get('img')->getData();
        
            if ($imageFile) {
                $newFilename = uniqid().'.'.$imageFile->guessExtension();
        
                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                    $stage->setImg($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors de l\'upload de l\'image : ' . $e->getMessage());
                }
            }
        
            // Met à jour les données en base
            $entityManager->flush();
        
            // Message flash de confirmation
            $this->addFlash(
                'success',
                "Les modifications ont été enregistrées"
            );
        }
        

        return $this->render('stages/edit.html.twig', [
            'stage'       => $stage,
            'formEdit'      => $formStageEdit
        ]);
    }

    /* ********************************** supprimer une stage ***************************************************  */
    /**
     * Route de suppression d'une stage
     * 
     * @route stage/delete/{id}
     * @name app_stage_delete
     * 
     * @param Stage $stage Entité Stage correspondante à l'ID transmise dans l'URL
     * @param EntityManagerInterface $entityManager (dépendance) Gestionnaire d'entités
     *
     * @return Response Réponse HTTP renvoyée au navigateur
     */
    #[Route('/stages/delete/{id<\d+>}', name: 'app_stages_delete')]
    public function delete(Stage $stage, EntityManagerInterface $entityManager): Response
    {
        try {

            // prépare l'objet à la suppression
            $entityManager->remove($stage);

            // on lance la suppression en base
            $entityManager->flush();

            // message
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

            // Je redirige vers la page de la photo
            return $this->redirectToRoute('app_stage_show', ['id' => $stage->getId()], 304);
        }
    }
    /* ********************************** postuler à une stage ***************************************************  */
    /**
     * Route pour postuler à un stage
     * 
     * @route stage/postuler/{id}
     * @name app_stage_postuler
     * 
     * @param Stage $stage Entité Stage correspondante à l'ID transmise dans l'URL
     * @param EntityManagerInterface $entityManager (dépendance) Gestionnaire d'entités
     * @param Request $request (dépendance) Objet contenant la requête envoyé par le navigateur ($_POST/$_GET)
     * 
     * @return Response Réponse HTTP renvoyée au navigateur
     */

     #[Route('/stages/postuler/{id<\d+>}', name: 'app_stages_postuler')]
     public function postuler(
        Stage $stage,
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

        if (!$stage) {
            throw $this->createNotFoundException('Offre stage introuvable');
        }

        $postuler = new Postuler();
        $formStagePostuler = $this->createForm(PostulerType::class, $postuler);
        $formStagePostuler->handleRequest($request);

        if ($formStagePostuler->isSubmitted() && $formStagePostuler->isValid()) {
            $postuler->setStage($stage);

            $cvFile = $formStagePostuler->get('cv')->getData();
            $lettreMotivationFile = $formStagePostuler->get('lettreMotivation')->getData();

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
            $createur = $stage->getUser();
            if ($createur) {
                $email = (new Email())
                    ->from($postuler->getEmail())
                    ->to($createur->getEmail())
                    ->subject('Nouvelle candidature pour votre offre : ' . $stage->getTitle())
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
            return $this->redirectToRoute('app_stages', ['id' => $stage->getId()]);
        }

        return $this->render('stages/postuler.html.twig', [
            'form' => $formStagePostuler->createView(),
            'stage' => $stage,
        ]);
    }
}
