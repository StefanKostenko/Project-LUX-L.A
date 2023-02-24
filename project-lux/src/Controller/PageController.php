<?php

namespace App\Controller;

use App\Entity\Eventos;
use App\Entity\Cocktail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Entrada;
use App\Form\EntradaFormType;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use App\Service\EntradaService;
use Symfony\Component\HttpFoundation\JsonResponse;

class PageController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig', []);
    }

    #[Route('/entradas/{tipo}', name: 'entradas')]
    public function entradas(ManagerRegistry $doctrine, Request $request, Pdf $knpSnappyPdf, EntradaService $entradaService, $tipo = 1): Response
    {
        if ($tipo == 1){
            $precio = 19;
        }elseif($tipo == 2){
            $precio = 29;
        }elseif($tipo == 3){
            $precio = 40;
        }elseif($tipo == 4){
            $precio = 65;
        }

        $entrada = new Entrada();
        $form = $this->createForm(EntradaFormType::class, $entrada);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entrada = $form->getData();    
            $entrada->setDate(new DateTime($form->get('date')->getData()));  
            $entrada->setCodigo($entradaService->generarCodigoAleatorio());

            $entityManager = $doctrine->getManager();    
            $entityManager->persist($entrada);
            $entityManager->flush();

            $snappy = new Pdf('/usr/local/bin/wkhtmltopdf');
            $snappy->setOption('page-size', 'A4');

            $html = $this->renderView('page/pdfEntrada.html.twig', array(
                'entrada' => $entrada,
            ));
            
            return new PdfResponse(
                $knpSnappyPdf->getOutputFromHtml($html),
                'entradaLUXLA.pdf'
            );

           
        }
        return $this->render('page/entradas.html.twig', array(
            'form' => $form->createView(), 'precio'=>$precio 
        ));

    }

    #[Route('/nosotros', name: 'nosotros')]
    public function nosotros(): Response
    {
        return $this->render('page/nosotros.html.twig');
    }

    #[Route('/cocktails', name: 'cocktails')]
    public function cocktails(): Response
    {
        return $this->render('page/cocktail.html.twig');
    }

    #[Route('/djs', name: 'djs')]
    public function djs(): Response
    {
        return $this->render('page/djs.html.twig');
    }

    #[Route('/guardarropa', name: 'guardarropa')]
    public function guardarropa(): Response
    {
        return $this->render('page/guardarropa.html.twig');
    }

    #[Route('/api/eventos', name: 'api_eventos')]
    public function apiEventos(ManagerRegistry $doctrine): JsonResponse
    {
        $repository = $doctrine->getRepository(Eventos::class);
        $events = $repository->findAll();
        $data = [];
        if(!$events){
            return new JsonResponse("[]", Response::HTTP_NOT_FOUND);
        }

        foreach($events as $event){
            $item = [
                "id"=> $event->getId(),
                "name"=> $event->getName(),
                "photo"=> $event->getPhoto(),
                "date"=> $event->getDate()
            ];
            $data[] = $item;
        }
        return new JsonResponse($data, Response::HTTP_OK);
        
    }
    #[Route('/eventos', name: 'eventos')]
    public function eventos(): Response
    {

        return $this->render('page/eventos.html.twig');
    }

    public function cocktailTemplate(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Cocktail::class);
        $cocktails = $repository->findAll();
        return $this->render('partials/_cocktails.html.twig',compact('cocktails'));
    }

    public function eventTemplate(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Eventos::class);
        $events = $repository->findAll();
        return $this->render('page/eventos.html.twig',compact('events'));
    }
}

