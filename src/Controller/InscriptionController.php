<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Form\InscriptionType;
use App\Repository\InscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/inscription')]
class InscriptionController extends AbstractController
{
    #[Route('/', name: 'inscription_index', methods: ['GET'])]
    public function index(InscriptionRepository $repo): Response
    {
        $inscriptions = $repo->findAll();
        return $this->render('inscription/index.html.twig', [
            'inscriptions' => $inscriptions,
        ]);
    }

    #[Route('/new', name: 'inscription_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $inscription = new Inscription();
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($inscription);
            $em->flush();

            return $this->redirectToRoute('inscription_index');
        }

        return $this->render('inscription/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'inscription_show', methods: ['GET'])]
    public function show(Inscription $inscription): Response
    {
        return $this->render('inscription/show.html.twig', [
            'inscription' => $inscription,
        ]);
    }

    #[Route('/{id}/edit', name: 'inscription_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Inscription $inscription, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('inscription_index');
        }

        return $this->render('inscription/edit.html.twig', [
            'form' => $form->createView(),
            'inscription' => $inscription,
        ]);
    }

    #[Route('/{id}', name: 'inscription_delete', methods: ['POST'])]
    public function delete(Request $request, Inscription $inscription, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inscription->getId(), $request->request->get('_token'))) {
            $em->remove($inscription);
            $em->flush();
        }

        return $this->redirectToRoute('inscription_index');
    }
}
