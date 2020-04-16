<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cine
 *
 * @ORM\Table(name="cine")
 * @ORM\Entity
 */
class Cine
{
    /**
     * @var string
     *
     * @ORM\Column(name="CIF", type="string", length=9, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cif;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="Tipo via", type="string", length=10, nullable=false)
     */
    private $tipoVia;

    /**
     * @var string
     *
     * @ORM\Column(name="Via", type="string", length=100, nullable=false)
     */
    private $via;

    /**
     * @var int
     *
     * @ORM\Column(name="Numero", type="integer", nullable=false)
     */
    private $numero;

    public function getCif(): ?string
    {
        return $this->cif;
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

    public function getTipoVia(): ?string
    {
        return $this->tipoVia;
    }

    public function setTipoVia(string $tipoVia): self
    {
        $this->tipoVia = $tipoVia;

        return $this;
    }

    public function getVia(): ?string
    {
        return $this->via;
    }

    public function setVia(string $via): self
    {
        $this->via = $via;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }


}
