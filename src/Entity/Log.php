<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Log
 *
 * @ORM\Table(name="log", indexes={@ORM\Index(name="id_users_1", columns={"id_users_1"})})
 * @ORM\Entity
 */
class Log
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_log", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLog;

    /**
     * @var int
     *
     * @ORM\Column(name="id_users", type="integer", nullable=false)
     */
    private $idUsers;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="text", length=65535, nullable=false)
     */
    private $action;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime", nullable=false)
     */
    private $data;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_users_1", referencedColumnName="id_users")
     * })
     */
    private $idUsers1;


}
