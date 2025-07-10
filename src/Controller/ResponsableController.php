<?php

namespace App\Controller;

use App\Entity\Responsable;
use App\Form\ResponsableType;
use App\Repository\ResponsableRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/responsable')]
class ResponsableController extends AbstractController
{
    #[Route('/', name: 'responsable_index', methods: ['GET'])]
    public function index(ResponsableRepository $repo): Response
    {
        $responsables = $repo->findAll();
        return $this->render('responsable/index.html.twig', [
            'responsables' => $responsables,
        ]);
    }

    #[Route('/new', name: 'responsable_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $responsable = new Responsable();
        $form = $this->createForm(ResponsableType::class, $responsable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($responsable);
            $em->flush();

            return $this->redirectToRoute('responsable_index');
        }

        return $this->render('responsable/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'responsable_show', methods: ['GET'])]
    public function show(Responsable $responsable): Response
    {
        return $this->render('responsable/show.html.twig', [
            'responsable' => $responsable,
        ]);
    }

    #[Route('/{id}/edit', name: 'responsable_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Responsable $responsable, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ResponsableType::class, $responsable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('responsable_index');
        }

        return $this->render('responsable/edit.html.twig', [
            'form' => $form->createView(),
            'responsable' => $responsable,
        ]);
    }

    #[Route('/{id}', name: 'responsable_delete', methods: ['POST'])]
    public function delete(Request $request, Responsable $responsable, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$responsable->getId(), $request->request->get('_token'))) {
            $em->remove($responsable);
            $em->flush();
        }

        return $this->redirectToRoute('responsable_index');
    }
}
