<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})})
 * @ORM\Entity
 */
class Utilisateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_users", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUsers;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=12, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="date", nullable=false)
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse1", type="string", length=50, nullable=false)
     */
    private $adresse1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse2", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $adresse2 = 'NULL';

    /**
     * @var int
     *
     * @ORM\Column(name="codePostale", type="integer", nullable=false)
     */
    private $codepostale;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=25, nullable=false)
     */
    private $ville;

    /**
     * @var bool
     *
     * @ORM\Column(name="admin", type="boolean", nullable=false)
     */
    private $admin;


}
