<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asiento
 *
 * @ORM\Table(name="asiento", indexes={@ORM\Index(name="fk_Asiento_Sala1_idx", columns={"Sala_idSala"})})
 * @ORM\Entity
 */
class Asiento
{
    /**
     * @var int
     *
     * @ORM\Column(name="idAsiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idasiento;

    /**
     * @var string
     *
     * @ORM\Column(name="Tipo", type="string", length=11, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="Estado", type="string", length=7, nullable=false)
     */
    private $estado;

    /**
     * @var \Sala
     *
     * @ORM\ManyToOne(targetEntity="Sala")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Sala_idSala", referencedColumnName="idSala")
     * })
     */
    private $salaIdsala;

    public function getIdasiento(): ?int
    {
        return $this->idasiento;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getSalaIdsala(): ?Sala
    {
        return $this->salaIdsala;
    }

    public function setSalaIdsala(?Sala $salaIdsala): self
    {
        $this->salaIdsala = $salaIdsala;

        return $this;
    }
}
