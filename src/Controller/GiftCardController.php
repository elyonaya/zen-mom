<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GiftCardController extends AbstractController
{
    #[Route('/gift_card', name: 'app_gift_card')]
    public function index(): Response
    {
        return $this->render('gift_card/gift_card.html.twig', [
            'controller_name' => 'GiftCardController',
        ]);
    }
}
