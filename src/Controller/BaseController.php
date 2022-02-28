<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    #[Route('/base', name: 'base')]
    public function index(): Response
    {
        return $this->render('base/index.html.twig', []);
    }

    #[Route('/bricotheque', name: 'bricotheque')]
    public function bricoteque(): Response
    {
        return $this->render('base/bricotheque.html.twig', []);
    }
    
    #[Route('/accompagnement-jeunesse', name: 'accompagnement-jeunesse')]
    public function accompagnement(): Response
    {
        return $this->render('base/accompagnement.html.twig', []);
    }    

    #[Route('/mobilite-jeunesse', name: 'mobilite-jeunesse')]
    public function mobilite(): Response
    {
        return $this->render('base/mobilite.html.twig', []);
    }

    #[Route('/actu', name: 'actu')]
    public function actu(): Response
    {
        return $this->render('base/actu.html.twig', []);
    }

    #[Route('/evenements', name: 'evenements')]
    public function evenements(): Response
    {
        return $this->render('base/evenements.html.twig', []);
    }

    #[Route('/admin-tuto', name: 'admin-tuto')]
    public function adminTuto(): Response
    {
        return $this->render('base/admin-tuto.html.twig', []);
    }
}
