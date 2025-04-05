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
    /**
     * Page d'affichage de la liste complète des stages en base
     * 
     * @route astages/
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
            
            // prépare les données à être sauvegarder en base
            $entityManager->persist($stage);

            //enregistre les données en base et créer l'Id unique
            $entityManager->flush();
        }

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
            // Le persist n'est pas à faire en cas de modification, les données provenant déjà la base

            // Met à jour les données en base
            $entityManager->flush();

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

            // Je redirige vers la page de la photo
            return $this->redirectToRoute('app_picture_show', ['id' => $stage->getId()], 304);
        }
    }
    /* ********************************** postuler à une stage ***************************************************  */
}
