<?php

namespace App\Controller;

use App\Entity\TestPrerequis;
use App\Form\TestPrerequisType;
use App\Repository\TestPrerequisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/test-prerequis')]
class TestPrerequisController extends AbstractController
{
    #[Route('/', name: 'test_prerequis_index', methods: ['GET'])]
    public function index(TestPrerequisRepository $repo): Response
    {
        $tests = $repo->findAll();
        return $this->render('test_prerequis/index.html.twig', ['tests_prerequis' => $tests]);
    }

    #[Route('/new', name: 'test_prerequis_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $test = new TestPrerequis();
        $form = $this->createForm(TestPrerequisType::class, $test);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($test);
            $em->flush();

            return $this->redirectToRoute('test_prerequis_index');
        }

        return $this->render('test_prerequis/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'test_prerequis_show', methods: ['GET'])]
    public function show(TestPrerequis $test): Response
    {
        return $this->render('test_prerequis/show.html.twig', [
            'test_prerequis' => $test,
        ]);
    }

    #[Route('/{id}/edit', name: 'test_prerequis_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TestPrerequis $test, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(TestPrerequisType::class, $test);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('test_prerequis_index');
        }

        return $this->render('test_prerequis/edit.html.twig', [
            'form' => $form->createView(),
            'test_prerequis' => $test,
        ]);
    }

    #[Route('/{id}', name: 'test_prerequis_delete', methods: ['POST'])]
    public function delete(Request $request, TestPrerequis $test, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$test->getId(), $request->request->get('_token'))) {
            $em->remove($test);
            $em->flush();
        }

        return $this->redirectToRoute('test_prerequis_index');
    }
}
