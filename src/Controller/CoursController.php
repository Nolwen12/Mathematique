<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ChapitreRepository;
use App\Entity\Chapitre;
use App\Repository\ExerciceRepository;
use App\Entity\Exercice;
use App\Entity\Correction;
use App\Repository\CorrectionRepository;
use App\Entity\Niveau;

final class CoursController extends AbstractController
{
    #[Route('/cours', name: 'app_cours')]
    public function index(): Response
    {
        return $this->render('cours/index.html.twig', [
            'controller_name' => 'CoursController',
        ]);
    }

    #[Route(name: 'app_chapitre_index', methods: ['GET'])]
    public function index_chapitre(ChapitreRepository $chapitreRepository): Response
    {
        return $this->render('chapitre/index.html.twig', [
            'chapitres' => $chapitreRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_chapitre_show', methods: ['GET'])]
    public function show_chapitre(Chapitre $chapitre): Response
    {
        return $this->render('chapitre/show.html.twig', [
            'chapitre' => $chapitre,
        ]);
    }

    #[Route(name: 'app_exercice_index', methods: ['GET'])]
    public function index_exercice(ExerciceRepository $exerciceRepository): Response
    {
        return $this->render('exercice/index.html.twig', [
            'exercices' => $exerciceRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_exercice_show', methods: ['GET'])]
    public function show_exercice(Exercice $exercice): Response
    {
        return $this->render('exercice/show.html.twig', [
            'exercice' => $exercice,
        ]);
    }

    #[Route(name: 'app_correction_index', methods: ['GET'])]
    public function index_correction(CorrectionRepository $correctionRepository): Response
    {
        return $this->render('correction/index.html.twig', [
            'corrections' => $correctionRepository->findAll(),
        ]);
    }

     #[Route('/{id}', name: 'app_correction_show', methods: ['GET'])]
    public function show_correction(Correction $correction): Response
    {
        return $this->render('correction/show.html.twig', [
            'correction' => $correction,
        ]);
    }

    #[Route('/{id}', name: 'app_niveau_show', methods: ['GET'])]
    public function show_niveau(Niveau $niveau, CategorieRepository $categorieRepository): Response
    {
        return $this->render('cours/niveau.html.twig', [
            'niveau' => $niveau,
            'categorue' => $categorieRepository->findAll(),
        ]);
    }   
}
