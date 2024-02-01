<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", uniqueConstraints={@ORM\UniqueConstraint(name="Id_CarteCadeau", columns={"Id_CarteCadeau"})}, indexes={@ORM\Index(name="Id_massage", columns={"Id_massage"}), @ORM\Index(name="id_users", columns={"id_users"}), @ORM\Index(name="Id_masseur", columns={"Id_masseur"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_reservation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReservation;

    /**
     * @var string
     *
     * @ORM\Column(name="duree", type="string", length=8, nullable=false)
     */
    private $duree;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reservation", type="date", nullable=false)
     */
    private $dateReservation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heure_reservation", type="time", nullable=true, options={"default"="NULL"})
     */
    private $heureReservation = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="huile", type="string", length=20, nullable=false)
     */
    private $huile;

    /**
     * @var int
     *
     * @ORM\Column(name="Statut_reservation", type="integer", nullable=false)
     */
    private $statutReservation;

    /**
     * @var \Cartecadeau
     *
     * @ORM\ManyToOne(targetEntity="Cartecadeau")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_CarteCadeau", referencedColumnName="Id_CarteCadeau")
     * })
     */
    private $idCartecadeau;

    /**
     * @var \Masseurs
     *
     * @ORM\ManyToOne(targetEntity="Masseurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_masseur", referencedColumnName="Id_masseur")
     * })
     */
    private $idMasseur;

    /**
     * @var \Massages
     *
     * @ORM\ManyToOne(targetEntity="Massages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_massage", referencedColumnName="Id_massage")
     * })
     */
    private $idMassage;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_users", referencedColumnName="id_users")
     * })
     */
    private $idUsers;


}
