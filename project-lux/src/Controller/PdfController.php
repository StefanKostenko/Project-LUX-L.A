<?php

namespace App\Controller;

use App\Entity\Entrada;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;


class PdfController extends AbstractController
{
   
    public function index(ManagerRegistry $doctrine, Pdf $knpSnappyPdf): Response
    {
        $repository = $doctrine->getRepository(Entrada::class);


        $entrada = $repository->findAll();
        
        $snappy = new Pdf('/usr/local/bin/wkhtmltopdf');
        $snappy->setOption('page-size', 'A4');
        
        $html = $this->renderView('page/pdfEntrada.html.twig', array(
            'entrada' => $entrada,
        ));
        
        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html),
            'file.pdf'
        );
    }

    
}
