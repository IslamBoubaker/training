<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // Préparation et envoi de l'email
            $email = (new Email())
                ->from($data['email'])
                ->to('service-commercial@it-training.fr') // à adapter
                ->subject('Demande de contact via le site')
                ->text("Nom : {$data['nom']}\nEmail : {$data['email']}\n\nMessage :\n{$data['message']}");

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a bien été envoyé.');

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}
