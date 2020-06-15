<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Genero
 *
 * @ORM\Table(name="genero")
 * @ORM\Entity
 */
class Genero
{
    /**
     * @var int
     *
     * @ORM\Column(name="idGenero", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idgenero;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=15, nullable=false)
     * @Assert\Length(
     * min=3,
     * minMessage = "Debe contener al menos 3 carácteres",
     * max=15,
     * maxMessage = "Debe contener 15 caracteres como máximo"
     * )
     */
    private $nombre;

    public function getIdgenero(): ?int
    {
        return $this->idgenero;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
