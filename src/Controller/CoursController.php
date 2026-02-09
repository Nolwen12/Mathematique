<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use App\Repository\NiveauRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ChapitreRepository;
use App\Entity\Chapitre;
use App\Entity\Exercice;
use App\Repository\ExerciceRepository;
use App\Entity\Correction;
use App\Entity\Niveau;

#[Route('/cours')]
final class CoursController extends AbstractController
{
    #[Route(name: 'app_cours')]
    public function index(NiveauRepository $niveauRepository): Response
    {
        return $this->render('cours/index.html.twig', [
            'controller_name' => 'CoursController',
            'niveau' => $niveauRepository->findAll(),
        ]);
    }

    #[Route('niveau/{id}', name: 'app_niveau_show', methods: ['GET'])]
    public function show_niveau(Niveau $niveau, CategorieRepository $categorieRepository, ChapitreRepository $chapitreRepository, Categorie $categorie): Response
    {
        return $this->render('cours/niveau.html.twig', [
            'niveau' => $niveau,
            'categorie' => $categorieRepository->findAll(),
            'chapitre' => $chapitreRepository->findByCategorie($categorie->getId()),
        ]);
    }

    #[Route('/chapitre/{id}', name: 'app_cours_chapitre_show', methods: ['GET'])]
    public function show_chapitre(Chapitre $chapitre): Response
    {
        return $this->render('cours/chapitre.html.twig', [
            'chapitre' => $chapitre,
            'exercice' => $chapitre->getChapitre(),
        ]);
    }

    #[Route('/exercice/{id}', name: 'app_cours_exercice_show', methods: ['GET'])]
    public function show_exercice(Exercice $exercice): Response
    {
        return $this->render('cours/exercice.html.twig', [
            'exercice' => $exercice,
            'correction' => $exercice->getCorrection(),
        ]);
    }

     #[Route('/correction/{id}', name: 'app_cours_correction_show', methods: ['GET'])]
    public function show_correction(Correction $correction): Response
    {
        return $this->render('cours/correction.html.twig', [
            'correction' => $correction,
        ]);
    }   
}
