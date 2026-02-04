<?php

namespace App\Controller;

use App\Entity\Correction;
use App\Form\CorrectionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/correction')]
final class CorrectionController extends AbstractController
{
    #[Route('/new', name: 'app_correction_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $correction = new Correction();
        $form = $this->createForm(CorrectionType::class, $correction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($correction);
            $entityManager->flush();

            return $this->redirectToRoute('app_correction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('correction/new.html.twig', [
            'correction' => $correction,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_correction_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Correction $correction, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CorrectionType::class, $correction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_correction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('correction/edit.html.twig', [
            'correction' => $correction,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_correction_delete', methods: ['POST'])]
    public function delete(Request $request, Correction $correction, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$correction->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($correction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_correction_index', [], Response::HTTP_SEE_OTHER);
    }
}
