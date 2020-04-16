<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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


}
