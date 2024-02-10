<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Importation du contrôleur abstrait de Symfony
use Symfony\Component\HttpFoundation\Response; // Importation de la classe Response de Symfony
use Symfony\Component\Routing\Annotation\Route; // Importation de l'annotation Route pour définir les routes

class HomeController extends AbstractController // Définition de la classe HomeController, qui hérite du contrôleur abstrait
{
    #[Route('/', name: 'app_home')] // Annotation Route pour définir la route /
    public function index(): Response // Définition de la méthode index qui renvoie un objet Response
    {
        return $this->render('home/accueil.html.twig', [ // Rendu du template home/accueil.html.twig avec des données
            'controller_name' => 'HomeController', // Passage d'une variable controller_name à la vue
        ]);
    }
}
