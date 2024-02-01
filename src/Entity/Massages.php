<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Massages
 *
 * @ORM\Table(name="massages")
 * @ORM\Entity
 */
class Massages
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_massage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMassage;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=25, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=50, nullable=false)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="duree", type="string", length=30, nullable=false)
     */
    private $duree;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Masseurs", inversedBy="idMassage")
     * @ORM\JoinTable(name="pratique",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Id_massage", referencedColumnName="Id_massage")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Id_masseur", referencedColumnName="Id_masseur")
     *   }
     * )
     */
    private $idMasseur = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idMasseur = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
