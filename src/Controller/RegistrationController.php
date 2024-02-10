<?php

namespace App\Controller;

use App\Entity\User; // Importation de la classe User
use App\Form\RegistrationFormType; // Importation du formulaire RegistrationFormType
use Doctrine\ORM\EntityManagerInterface; // Importation de l'EntityManagerInterface pour la gestion des entités
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Importation du contrôleur abstrait de Symfony
use Symfony\Component\HttpFoundation\Request; // Importation de la classe Request de Symfony
use Symfony\Component\HttpFoundation\Response; // Importation de la classe Response de Symfony
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface; // Importation de l'interface UserPasswordHasherInterface pour le hachage des mots de passe
use Symfony\Component\Routing\Annotation\Route; // Importation de l'annotation Route pour définir les routes
use Symfony\Contracts\Translation\TranslatorInterface; // Importation de l'interface TranslatorInterface pour la traduction

class RegistrationController extends AbstractController // Définition de la classe RegistrationController, qui hérite du contrôleur abstrait
{
    #[Route('/register', name: 'app_register')] // Annotation Route pour définir la route /register
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response // Définition de la méthode register avec les paramètres Request, UserPasswordHasherInterface et EntityManagerInterface
    {
        $user = new User(); // Création d'une nouvelle instance de la classe User
        $form = $this->createForm(RegistrationFormType::class, $user); // Création du formulaire en utilisant RegistrationFormType et les données de l'utilisateur
        $form->handleRequest($request); // Gestion de la requête du formulaire

        if ($form->isSubmitted() && $form->isValid()) { // Vérification si le formulaire est soumis et valide
            // encode the plain password
            $user->setPassword( // Définition du mot de passe haché
                $userPasswordHasher->hashPassword( // Hachage du mot de passe
                    $user,
                    $form->get('plainPassword')->getData() // Récupération du mot de passe en clair depuis le formulaire
                )
            );

            $entityManager->persist($user); // Persister l'utilisateur dans l'EntityManager
            $entityManager->flush(); // Enregistrer les modifications dans la base de données
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login'); // Redirection vers la page de connexion
        }

        return $this->render('registration/register.html.twig', [ // Rendu du template registration/register.html.twig avec le formulaire
            'registrationForm' => $form->createView(), // Passage du formulaire à la vue
        ]);
    }
}
