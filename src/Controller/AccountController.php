<?php

namespace App\Controller;

use App\Entity\User; // Importation de la classe User
use App\Form\UserType; // Importation du formulaire UserType
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Importation du contrôleur abstrait de Symfony
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface; // Importation de l'interface UserPasswordHasherInterface
use Symfony\Component\HttpFoundation\Response; // Importation de la classe Response de Symfony
use Symfony\Component\HttpFoundation\Request; // Importation de la classe Request de Symfony
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface; // Importation de l'interface TokenStorageInterface pour le stockage du jeton
use Symfony\Component\Routing\Annotation\Route; // Importation de l'annotation Route pour définir les routes
use Doctrine\ORM\EntityManagerInterface; // Importation de l'EntityManagerInterface pour la gestion des entités

class AccountController extends AbstractController // Définition de la classe AccountController, qui hérite du contrôleur abstrait
{
    private $entityManager; // Déclaration de la propriété entityManager
    private $tokenStorage; // Déclaration de la propriété tokenStorage

    public function __construct(EntityManagerInterface $manager, TokenStorageInterface $tokenStorage) // Définition du constructeur
    {
        $this->entityManager = $manager; // Initialisation de la propriété entityManager
        $this->tokenStorage = $tokenStorage; // Initialisation de la propriété tokenStorage
    }

    #[Route('/account', name: 'app_account')] // Annotation Route pour définir la route /account
    public function account(Request $request, UserPasswordHasherInterface $userPasswordHasher): Response // Définition de la méthode account avec les paramètres Request et UserPasswordHasherInterface
    {
        $user = $this->getUser(); // Récupération de l'utilisateur actuellement authentifié

        if (!$user) { // Vérification si l'utilisateur est connecté
            return $this->redirectToRoute('app_login'); // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        }

        $form = $this->createForm(UserType::class, $user); // Création du formulaire en utilisant UserType et les données de l'utilisateur
        $form->handleRequest($request); // Gestion de la requête du formulaire

        if ($form->isSubmitted() && $form->isValid()) { // Vérification si le formulaire est soumis et valide
            // Hasher le mot de passe uniquement s'il a été modifié dans le formulaire
            if ($form->get('plainPassword')->getData() !== null) {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );
            }

            $this->entityManager->flush(); // Enregistrer les modifications dans la base de données

            $this->addFlash('success', 'Account updated successfully!'); // Ajout d'un message flash de succès

            return $this->redirectToRoute('app_account'); // Redirection vers la page de compte
        }

        return $this->render('account/account.html.twig', [ // Rendu du template account.html.twig avec le formulaire
            'form' => $form->createView(), // Passage du formulaire à la vue
        ]);
    }

    #[Route('/updateAccount', name: 'app_updateAccount')] // Annotation Route pour définir la route /updateAccount
    public function updateAccount(Request $request, $id): Response // Définition de la méthode updateAccount avec les paramètres Request et $id
    {
        $user = $this->entityManager->getRepository(User::class)->find($id); // Récupération de l'utilisateur à partir de l'identifiant

        if (!$user) { // Vérification si l'utilisateur existe
            throw $this->createNotFoundException('User not found'); // Lancer une exception si l'utilisateur n'est pas trouvé
        }

        $form = $this->createForm(UserType::class, $user); // Création du formulaire en utilisant UserType et les données de l'utilisateur
        $form->handleRequest($request); // Gestion de la requête du formulaire

        if ($form->isSubmitted() && $form->isValid()) { // Vérification si le formulaire est soumis et valide
            $this->entityManager->flush(); // Enregistrer les modifications dans la base de données

            $this->addFlash('success', 'Account updated successfully!'); // Ajout d'un message flash de succès

            return $this->redirectToRoute('app_account'); // Redirection vers la page de compte
        }

        return $this->render('account/update_account.html.twig', [ // Rendu du template update_account.html.twig avec le formulaire
            'form' => $form->createView(), // Passage du formulaire à la vue
        ]);
    }

    #[Route('/deleteAccount/{id}', name: 'app_deleteAccount')] // Annotation Route pour définir la route /deleteAccount avec un paramètre {id}
    public function deleteAccount(Request $request, $id): Response // Définition de la méthode deleteAccount avec les paramètres Request et $id
    {
        $user = $this->entityManager->getRepository(User::class)->find($id); // Récupération de l'utilisateur à partir de l'identifiant

        if (!$user) { // Vérification si l'utilisateur existe
            throw $this->createNotFoundException('User not found'); // Lancer une exception si l'utilisateur n'est pas trouvé
        }

        $this->entityManager->remove($user); // Suppression de l'utilisateur de la base de données
        $this->entityManager->flush(); // Enregistrer les modifications dans la base de données

        $this->tokenStorage->setToken(null); // Déconnexion de l'utilisateur

        return $this->redirectToRoute('app_home'); // Redirection vers la page d'accueil
    }
}
