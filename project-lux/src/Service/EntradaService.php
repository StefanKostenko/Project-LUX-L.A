<?php
// src/Service/EntradaService.php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Entrada;

class EntradaService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function generarCodigoAleatorio($longitud = 8)
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codigo = '';
        $maxIntentos = 100;
        $intentos = 0;

        do {
            $codigo = '';

            for ($i = 0; $i < $longitud; $i++) {
                $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
            }

            // Comprobar si el código ya existe en la base de datos
            $entrada = $this->entityManager->getRepository(Entrada::class)->findOneBy(['codigo' => $codigo]);
            $intentos++;
        } while ($entrada && $intentos < $maxIntentos);

        if ($entrada) {
            throw new \Exception('No se ha podido generar un código único en ' . $maxIntentos . ' intentos.');
        }

        return $codigo;
    }
}
