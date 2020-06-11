<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entrada
 *
 * @ORM\Table(name="entrada", indexes={@ORM\Index(name="fk_entrada_horario1_idx", columns={"horario_idHorario"}), @ORM\Index(name="fk_Sala_has_Pelicula_Asiento1_idx", columns={"Asiento_idAsiento"})})
 * @ORM\Entity
 */
class Entrada
{
    /**
     * @var int
     *
     * @ORM\Column(name="idEntrada", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $identrada;

    /**
     * @var \Asiento
     *
     * @ORM\ManyToOne(targetEntity="Asiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Asiento_idAsiento", referencedColumnName="idAsiento")
     * })
     */
    private $asientoIdasiento;

    /**
     * @var \Horario
     *
     * @ORM\ManyToOne(targetEntity="Horario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="horario_idHorario", referencedColumnName="idHorario")
     * })
     */
    private $horarioIdhorario;

    public function getIdentrada(): ?int
    {
        return $this->identrada;
    }

    public function getAsientoIdasiento()
    {
        return $this->asientoIdasiento;
    }

    public function setAsientoIdasiento(?Asiento $asientoIdasiento): self
    {
        $this->asientoIdasiento = $asientoIdasiento;

        return $this;
    }

    public function getHorarioIdhorario()
    {
        return $this->horarioIdhorario;
    }

    public function setHorarioIdhorario(?Horario $horarioIdhorario): self
    {
        $this->horarioIdhorario = $horarioIdhorario;

        return $this;
    }
}
