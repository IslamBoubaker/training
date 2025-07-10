<?php

namespace App\Controller;

use App\Entity\Session;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/session')]
class SessionController extends AbstractController
{
    #[Route('/', name: 'session_index', methods: ['GET'])]
    public function index(SessionRepository $repo): Response
    {
        $sessions = $repo->findAll();
        return $this->render('session/index.html.twig', [
            'sessions' => $sessions,
        ]);
    }

    #[Route('/new', name: 'session_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $session = new Session();
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($session);
            $em->flush();

            return $this->redirectToRoute('session_index');
        }

        return $this->render('session/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'session_show', methods: ['GET'])]
    public function show(Session $session): Response
    {
        return $this->render('session/show.html.twig', [
            'session' => $session,
        ]);
    }

    #[Route('/{id}/edit', name: 'session_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Session $session, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('session_index');
        }

        return $this->render('session/edit.html.twig', [
            'form' => $form->createView(),
            'session' => $session,
        ]);
    }

    #[Route('/{id}', name: 'session_delete', methods: ['POST'])]
    public function delete(Request $request, Session $session, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$session->getId(), $request->request->get('_token'))) {
            $em->remove($session);
            $em->flush();
        }

        return $this->redirectToRoute('session_index');
    }
}
