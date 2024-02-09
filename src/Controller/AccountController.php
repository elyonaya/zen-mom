<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;


class AccountController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $manager ,TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $manager;
        $this->tokenStorage = $tokenStorage;
    }

    #[Route('/account', name: 'app_account')]
    public function account(Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hasher le mot de passe uniquement s'il a été modifié dans le formulaire
            if ($form->get('plainPassword')->getData() !== null) {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );
            }

            $this->entityManager->flush();

            $this->addFlash('success', 'Account updated successfully!');

            return $this->redirectToRoute('app_account');
        }

        return $this->render('account/account.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/updateAccount', name: 'app_updateAccount')]
public function updateAccount(Request $request, $id): Response
{
    $user = $this->entityManager->getRepository(User::class)->find($id);

    if (!$user) {
        throw $this->createNotFoundException('User not found');
    }

    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Sauvegarder les modifications dans la base de données
        $this->entityManager->flush();

        $this->addFlash('success', 'Account updated successfully!');

        return $this->redirectToRoute('app_account');
    }

    return $this->render('account/update_account.html.twig', [
        'form' => $form->createView(),
    ]);
}
    #[Route('/deleteAccount/{id}', name: 'app_deleteAccount')]
    public function deleteAccount(Request $request, $id): Response
    {
        $user = $this->entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        // Supprimer l'utilisateur de la base de données
        $this->entityManager->remove($user);
        $this->entityManager->flush();
        // Déconnexion de l'utilisateur
        $this->tokenStorage->setToken(null);


        // Rediriger vers une page de confirmation ou une autre action
        return $this->redirectToRoute('app_home'); 
    }
}
