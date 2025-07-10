<?php

namespace App\Controller;

use App\Entity\Formateur;
use App\Form\FormateurType;
use App\Repository\FormateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/formateur')]
class FormateurController extends AbstractController
{
    #[Route('/', name: 'formateur_index', methods: ['GET'])]
    public function index(FormateurRepository $repo): Response
    {
        $formateurs = $repo->findAll();
        return $this->render('formateur/index.html.twig', [
            'formateurs' => $formateurs,
        ]);
    }

    #[Route('/new', name: 'formateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $formateur = new Formateur();
        $form = $this->createForm(FormateurType::class, $formateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($formateur);
            $em->flush();

            return $this->redirectToRoute('formateur_index');
        }

        return $this->render('formateur/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'formateur_show', methods: ['GET'])]
    public function show(Formateur $formateur): Response
    {
        return $this->render('formateur/show.html.twig', [
            'formateur' => $formateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'formateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formateur $formateur, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(FormateurType::class, $formateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('formateur_index');
        }

        return $this->render('formateur/edit.html.twig', [
            'form' => $form->createView(),
            'formateur' => $formateur,
        ]);
    }

    #[Route('/{id}', name: 'formateur_delete', methods: ['POST'])]
    public function delete(Request $request, Formateur $formateur, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formateur->getId(), $request->request->get('_token'))) {
            $em->remove($formateur);
            $em->flush();
        }

        return $this->redirectToRoute('formateur_index');
    }
}
