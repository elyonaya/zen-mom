<?php

namespace App\Entity;

use App\Repository\UserRepository; // Importation de la classe UserRepository
use Doctrine\DBAL\Types\Types; // Importation des types de données de Doctrine
use Doctrine\ORM\Mapping as ORM; // Importation de l'espace de noms ORM de Doctrine
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity; // Importation de l'annotation UniqueEntity de Symfony pour les contraintes de validation
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface; // Importation de l'interface PasswordAuthenticatedUserInterface de Symfony pour l'authentification par mot de passe
use Symfony\Component\Security\Core\User\UserInterface; // Importation de l'interface UserInterface de Symfony pour l'utilisateur
use Symfony\Component\Validator\Constraints as Assert; // Importation de la classe Constraints de Symfony pour les contraintes de validation

#[ORM\Entity(repositoryClass: UserRepository::class)] // Annotation pour définir l'entité et le repository associé
#[UniqueEntity(fields: ['email'], message: 'Il existe déjà un compte avec cet email')] // Annotation pour définir une contrainte d'unicité sur le champ email
class User implements UserInterface, PasswordAuthenticatedUserInterface // Définition de la classe User, implémentant les interfaces UserInterface et PasswordAuthenticatedUserInterface
{
    #[ORM\Id] // Annotation pour définir la clé primaire
    #[ORM\GeneratedValue] // Annotation pour générer la valeur automatiquement
    #[ORM\Column] // Annotation pour définir une colonne de base de données
    private ?int $id = null; // Déclaration de la propriété id avec un type nullable int

    #[ORM\Column(length: 180, unique: true)] // Annotation pour définir une colonne avec une longueur de 180 et unique
    private ?string $email = null; // Déclaration de la propriété email avec un type nullable string

    #[ORM\Column] // Annotation pour définir une colonne de base de données
     /**
     * @Assert\EqualTo(propertyPath="email")
     */
    private $emailConfirmation; // Déclaration de la propriété emailConfirmation

    private array $roles = []; // Déclaration de la propriété roles comme un tableau

    /**
     * @var string The hashed password
     */
    #[ORM\Column] // Annotation pour définir une colonne de base de données
    private ?string $password = null; // Déclaration de la propriété password avec un type nullable string

    #[ORM\Column(length: 255)] // Annotation pour définir une colonne avec une longueur de 255
    private ?string $nom = null; // Déclaration de la propriété nom avec un type nullable string

    #[ORM\Column(length: 50)] // Annotation pour définir une colonne avec une longueur de 50
    private ?string $prenom = null; // Déclaration de la propriété prenom avec un type nullable string

    #[ORM\Column(type:"date", nullable:true)] // Annotation pour définir une colonne de type date et nullable
    private ?\DateTimeInterface $datenaissance = null; // Déclaration de la propriété datenaissance avec un type nullable \DateTimeInterface

    #[ORM\Column(length: 255, nullable:true)] // Annotation pour définir une colonne avec une longueur de 255 et nullable
    private ?string $adresse1 = null; // Déclaration de la propriété adresse1 avec un type nullable string

    #[ORM\Column(length: 255, nullable: true)] // Annotation pour définir une colonne avec une longueur de 255 et nullable
    private ?string $adress2 = null; // Déclaration de la propriété adress2 avec un type nullable string

    #[ORM\Column(nullable:true)] // Annotation pour définir une colonne nullable
    private ?int $codePostale = null; // Déclaration de la propriété codePostale avec un type nullable int

    #[ORM\Column(length: 25 , nullable:true)] // Annotation pour définir une colonne avec une longueur de 25 et nullable
    private ?string $ville = null; // Déclaration de la propriété ville avec un type nullable string

    public function getId(): ?int // Définition de la méthode getId qui retourne un int ou null
    {
        return $this->id; // Retour de la propriété id
    }

    public function getEmail(): ?string // Définition de la méthode getEmail qui retourne un string ou null
    {
        return $this->email; // Retour de la propriété email
    }

    public function setEmail(string $email): static // Définition de la méthode setEmail avec un paramètre email de type string et retourne un objet de la classe
    {
        $this->email = $email; // Attribution de la valeur de email à la propriété email

        return $this; // Retour de l'objet courant
    }

    /**
     * Un identifiant visuel qui représente cet utilisateur.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string // Définition de la méthode getUserIdentifier qui retourne un string
    {
        return (string) $this->email; // Retour de la propriété email en tant que string
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array // Définition de la méthode getRoles qui retourne un tableau
    {
        $roles = $this->roles; // Assignation de la propriété roles à la variable $roles
        // garantir que chaque utilisateur a au moins le rôle ROLE_USER
        $roles[] = 'ROLE_USER'; // Ajout du rôle ROLE_USER au tableau $roles

        return array_unique($roles); // Retour du tableau $roles en supprimant les doublons
    }

    public function setRoles(array $roles): static // Définition de la méthode setRoles avec un paramètre roles de type tableau et retourne un objet de la classe
    {
        $this->roles = $roles; // Attribution de la valeur de roles à la propriété roles

        return $this; // Retour de l'objet courant
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string // Définition de la méthode getPassword qui retourne un string
    {
        return $this->password; // Retour de la propriété password
    }

    public function setPassword(string $password): static // Définition de la méthode setPassword avec un paramètre password de type string et retourne un objet de la classe
    {
        $this->password = $password; // Attribution de la valeur de password à la propriété password

        return $this; // Retour de l'objet courant
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void // Définition de la méthode eraseCredentials qui ne retourne rien
    {
        // Si vous stockez des données temporaires ou sensibles sur l'utilisateur, effacez-les ici
        // $this->plainPassword = null;
    }

    public function getNom(): ?string // Définition de la méthode getNom
    {
        return $this->nom; // Retour de la propriété nom
    }

    public function setNom(string $nom): static // Définition de la méthode setNom avec un paramètre nom de type string et retourne un objet de la classe
    {
        $this->nom = $nom; // Attribution de la valeur de nom à la propriété nom

        return $this; // Retour de l'objet courant
    }

    public function getPrenom(): ?string // Définition de la méthode getPrenom
    {
        return $this->prenom; // Retour de la propriété prenom
    }

    public function setPrenom(string $prenom): static // Définition de la méthode setPrenom avec un paramètre prenom de type string et retourne un objet de la classe
    {
        $this->prenom = $prenom; // Attribution de la valeur de prenom à la propriété prenom

        return $this; // Retour de l'objet courant
    }

    public function getDateNaissance(): ?\DateTimeInterface // Définition de la méthode getDateNaissance
    {
        return $this->datenaissance; // Retour de la propriété datenaissance
    }

    public function setDateNaissance(\DateTimeInterface $datenaissance): static // Définition de la méthode setDateNaissance avec un paramètre datenaissance de type \DateTimeInterface et retourne un objet de la classe
    {
        $this->datenaissance = $datenaissance; // Attribution de la valeur de datenaissance à la propriété datenaissance

        return $this; // Retour de l'objet courant
    }

    public function getAdresse1(): ?string // Définition de la méthode getAdresse1
    {
        return $this->adresse1; // Retour de la propriété adresse1
    }

    public function setAdresse1(string $adresse1): static // Définition de la méthode setAdresse1 avec un paramètre adresse1 de type string et retourne un objet de la classe
    {
        $this->adresse1 = $adresse1; // Attribution de la valeur de adresse1 à la propriété adresse1

        return $this; // Retour de l'objet courant
    }

    public function getAdress2(): ?string // Définition de la méthode getAdress2
    {
        return $this->adress2; // Retour de la propriété adress2
    }

    public function setAdress2(?string $adress2): static // Définition de la méthode setAdress2 avec un paramètre adress2 de type string nullable et retourne un objet de la classe
    {
        $this->adress2 = $adress2; // Attribution de la valeur de adress2 à la propriété adress2

        return $this; // Retour de l'objet courant
    }

    public function getCodePostale(): ?int // Définition de la méthode getCodePostale
    {
        return $this->codePostale; // Retour de la propriété codePostale
    }

    public function setCodePostale(int $codePostale): static // Définition de la méthode setCodePostale avec un paramètre codePostale de type int et retourne un objet de la classe
    {
        $this->codePostale = $codePostale; // Attribution de la valeur de codePostale à la propriété codePostale

        return $this; // Retour de l'objet courant
    }

    public function getVille(): ?string // Définition de la méthode getVille
    {
        return $this->ville; // Retour de la propriété ville
    }

    public function setVille(string $ville): static // Définition de la méthode setVille avec un paramètre ville de type string et retourne un objet de la classe
    {
        $this->ville = $ville; // Attribution de la valeur de ville à la propriété ville

        return $this; // Retour de l'objet courant
    }
    public function getEmailConfirmation(): ?string // Définition de la méthode getEmailConfirmation
    {
        return $this->emailConfirmation; // Retour de la propriété emailConfirmation
    }

    public function setEmailConfirmation(string $emailConfirmation): self // Définition de la méthode setEmailConfirmation avec un paramètre emailConfirmation de type string et retourne un objet de la classe
    {
        $this->emailConfirmation = $emailConfirmation; // Attribution de la valeur de emailConfirmation à la propriété emailConfirmation

        return $this; // Retour de l'objet courant
    }
    private $plainPassword;

    public function getPlainPassword(): ?string // Définition de la méthode getPlainPassword
    {
        return $this->plainPassword; // Retour de la propriété plainPassword
    }

    public function setPlainPassword(string $plainPassword): void // Définition de la méthode setPlainPassword avec un paramètre plainPassword de type string et ne retourne rien
    {
        $this->plainPassword = $plainPassword; // Attribution de la valeur de plainPassword à la propriété plainPassword
    }
}

