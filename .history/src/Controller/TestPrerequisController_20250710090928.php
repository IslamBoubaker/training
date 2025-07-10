<?php

namespace App\Controller;

use App\Entity\TestPrerequis;
use App\Form\TestPrerequisType;
use App\Repository\TestPrerequisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/test/prerequis')]
final class TestPrerequisController extends AbstractController
{
    #[Route(name: 'app_test_prerequis_index', methods: ['GET'])]
    public function index(TestPrerequisRepository $testPrerequisRepository): Response
    {
        return $this->render('test_prerequis/index.html.twig', [
            'test_prerequis' => $testPrerequisRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_test_prerequis_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $testPrerequi = new TestPrerequis();
        $form = $this->createForm(TestPrerequisType::class, $testPrerequi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($testPrerequi);
            $entityManager->flush();

            return $this->redirectToRoute('app_test_prerequis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('test_prerequis/new.html.twig', [
            'test_prerequi' => $testPrerequi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_test_prerequis_show', methods: ['GET'])]
    public function show(TestPrerequis $testPrerequi): Response
    {
        return $this->render('test_prerequis/show.html.twig', [
            'test_prerequi' => $testPrerequi,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_test_prerequis_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TestPrerequis $testPrerequi, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TestPrerequisType::class, $testPrerequi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_test_prerequis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('test_prerequis/edit.html.twig', [
            'test_prerequi' => $testPrerequi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_test_prerequis_delete', methods: ['POST'])]
    public function delete(Request $request, TestPrerequis $testPrerequi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testPrerequi->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($testPrerequi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_test_prerequis_index', [], Response::HTTP_SEE_OTHER);
    }
}
