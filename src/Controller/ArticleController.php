<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ArticleType;
use App\Entity\Article;

class ArticleController extends AbstractController
{
    #[Route('/creerArticle', name: 'creerArticle')]
    public function creerArticle(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        return $this->render('article/creerArticle.html.twig', ['form' => $form->createView()]);
    }
}
