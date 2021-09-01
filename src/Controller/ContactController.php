<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('notice', 'Merci de nous avoir contacté. Notre équipe vous répondra dans les plus brefs délais');

            $mail = new Mail();
            $mail->send( 'syl20.garrigues@gmail.com',  $form->get('nom')->getData(), 'Formulaire de contact',  $form->get('content')->getData().$form->get('email')->getData() );


        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
}}
