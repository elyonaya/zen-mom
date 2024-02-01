<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Masseurs
 *
 * @ORM\Table(name="masseurs")
 * @ORM\Entity
 */
class Masseurs
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_masseur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMasseur;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=20, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=20, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="photos", type="blob", length=65535, nullable=false)
     */
    private $photos;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="disponibilite", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $disponibilite = 'NULL';

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Massages", mappedBy="idMasseur")
     */
    private $idMassage = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idMassage = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
