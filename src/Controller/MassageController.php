<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MassageController extends AbstractController
{
    #[Route('/massage', name: 'app_massage')]
    public function index(): Response
    {
        return $this->render('massage/massage.html.twig', [
            'controller_name' => 'MassageController',
        ]);
    }
}
