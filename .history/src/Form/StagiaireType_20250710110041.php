<?php

namespace App\Controller;

use App\Entity\Stagiaire;
use App\Form\StagiaireType;
use App\Repository\StagiaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/stagiaire')]
class StagiaireController extends AbstractController
{
    #[Route('/', name: 'stagiaire_index', methods: ['GET'])]
    public function index(StagiaireRepository $repo): Response
    {
        $stagiaires = $repo->findAll();
        return $this->render('stagiaire/index.html.twig', [
            'stagiaires' => $stagiaires,
        ]);
    }

    #[Route('/new', name: 'stagiaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $stagiaire = new Stagiaire();
        $form = $this->createForm(StagiaireType::class, $stagiaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($stagiaire);
            $em->flush();

            return $this->redirectToRoute('stagiaire_index');
        }

        return $this->render('stagiaire/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'stagiaire_show', methods: ['GET'])]
    public function show(Stagiaire $stagiaire): Response
    {
        return $this->render('stagiaire/show.html.twig', [
            'stagiaire' => $stagiaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'stagiaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Stagiaire $stagiaire, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(StagiaireType::class, $stagiaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('stagiaire_index');
        }

        return $this->render('stagiaire/edit.html.twig', [
            'form' => $form->createView(),
            'stagiaire' => $stagiaire,
        ]);
    }

    #[Route('/{id}', name: 'stagiaire_delete', methods: ['POST'])]
    public function delete(Request $request, Stagiaire $stagiaire, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stagiaire->getId(), $request->request->get('_token'))) {
            $em->remove($stagiaire);
            $em->flush();
        }

        return $this->redirectToRoute('stagiaire_index');
    }
}
