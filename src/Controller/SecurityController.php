<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Importation du contrôleur abstrait de Symfony
use Symfony\Component\HttpFoundation\Response; // Importation de la classe Response de Symfony
use Symfony\Component\Routing\Annotation\Route; // Importation de l'annotation Route pour définir les routes
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils; // Importation de la classe AuthenticationUtils pour gérer l'authentification

class SecurityController extends AbstractController // Définition de la classe SecurityController, qui hérite du contrôleur abstrait
{
    #[Route(path: '/login', name: 'app_login')] // Annotation Route pour définir la route /login
    public function login(AuthenticationUtils $authenticationUtils): Response // Définition de la méthode login avec le paramètre AuthenticationUtils
    {
        if ($this->getUser()) { // Vérification si l'utilisateur est déjà connecté
            return $this->redirectToRoute('account'); // Redirection vers la page de compte si l'utilisateur est déjà connecté
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError(); // Récupération de l'erreur de connexion, le cas échéant
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername(); // Récupération du dernier nom d'utilisateur saisi par l'utilisateur

        return $this->render('security/login.html.twig', [ // Rendu du template security/login.html.twig avec les données
            'last_username' => $lastUsername, // Passage du dernier nom d'utilisateur à la vue
            'error' => $error, // Passage de l'erreur de connexion à la vue
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')] // Annotation Route pour définir la route /logout
    public function logout(): void // Définition de la méthode logout qui ne retourne rien
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.'); // Lancer une exception logique
    }
}
