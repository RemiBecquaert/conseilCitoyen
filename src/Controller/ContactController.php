<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\Entity\Contact;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $email = (new TemplatedEmail())
                ->from($contact->getEmail())
                ->to('associationterrenoeve@outlook.fr')
                ->subject($contact->getSujet())
                ->htmlTemplate('emails/email.html.twig')
                ->context([
                    'nom'=> $contact->getNom(),
                    'prenom'=>$contact->getPrenom(),
                    'sujet'=> $contact->getSujet(),
                    'message'=> $contact->getMessage()
                ]);
                $contact->setDateContact(new \Datetime());
                $em = $this->getDoctrine()->getManager();
                $em->persist($contact);
                $em->flush();

                $mailer->send($email);

                $accuse = (new TemplatedEmail())
                ->from('associationterrenoeve@outlook.fr')
                ->to($contact->getEmail())
                ->subject('Confirmation de votre demande de contact')
                ->htmlTemplate('emails/confirmation-contact.html.twig')
                ->context([
                    'nom'=> $contact->getNom(),
                    'prenom'=>$contact->getPrenom(),
                    'sujet'=> $contact->getSujet(),
                    'message'=> $contact->getMessage()
                ]);
                $mailer->send($accuse);

                $this->addFlash('notice','Message envoyé !');
                return $this->redirectToRoute('contact');   
            }
        }
        return $this->render('contact/contact.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/liste-contact', name: 'liste-contact')]
    public function listeContact(): Response
    {
        $repoContact = $this->getDoctrine()->getRepository(Contact::class);
        $contacts = $repoContact->findAll();
        return $this->render('contact/liste-contact.html.twig', ['contacts' => $contacts 
        ]);
    }
    
}
