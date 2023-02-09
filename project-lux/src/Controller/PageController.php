<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig', []);
    }

    #[Route('/entradas', name: 'entradas')]
    public function entradas(): Response
    {
        return $this->render('page/entradas.html.twig', []);
    }

    #[Route('/login', name: 'login')]
    public function login(): Response
    {
        return $this->render('page/login.html.twig', []);
    }

    #[Route('/register', name: 'register')]
    public function register(): Response
    {
        return $this->render('page/register.html.twig', []);
    }

    #[Route('/nosotros', name: 'nosotros')]
    public function nosotros(): Response
    {
        return $this->render('page/nosotros.html.twig', []);
    }
}

