<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cartecadeau
 *
 * @ORM\Table(name="cartecadeau", uniqueConstraints={@ORM\UniqueConstraint(name="Code_k", columns={"Code_k"})})
 * @ORM\Entity
 */
class Cartecadeau
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_CarteCadeau", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCartecadeau;

    /**
     * @var string
     *
     * @ORM\Column(name="Code_k", type="string", length=20, nullable=false)
     */
    private $codeK;


}
