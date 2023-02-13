<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Entrada;
use App\Form\EntradaFormType;
use DateTime;
use Symfony\Component\HttpFoundation\Request;

class PageController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig', []);
    }

    #[Route('/entradas', name: 'entradas')]
    public function entradas(ManagerRegistry $doctrine, Request $request): Response
    {
        $entrada = new Entrada();
        $form = $this->createForm(EntradaFormType::class, $entrada);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entrada = $form->getData();    
            $entrada->setDate(new DateTime($form->get('date')->getData()));    
            $entityManager = $doctrine->getManager();    
            $entityManager->persist($entrada);
            $entityManager->flush();
            return $this->redirectToRoute('index', []);
        }
        return $this->render('page/entradas.html.twig', array(
            'form' => $form->createView()    
        ));

    }

    #[Route('/nosotros', name: 'nosotros')]
    public function nosotros(): Response
    {
        return $this->render('page/nosotros.html.twig', []);
    }

    #[Route('/singleUser', name: 'singleUser')]
    public function singleUser(): Response
    {
        return $this->render('page/singleUser.html.twig', []);
    }
}

