<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Massages;

class MassagesController extends AbstractController
{
    #[Route('/massages', name: 'app_massages')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $massages = $entityManager->getRepository(Massages::class)->findAll();
        return $this->render('massages/massage.html.twig', ['massage' => $massages]);
    }


}