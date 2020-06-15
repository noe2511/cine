<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reserva
 *
 * @ORM\Table(name="reserva", indexes={@ORM\Index(name="fk_reserva_horario1_idx", columns={"horario_idHorario"}), @ORM\Index(name="fk_reserva_asiento1_idx", columns={"asiento_idAsiento"})})
 * @ORM\Entity
 */
class Reserva
{
    /**
     * @var int
     *
     * @ORM\Column(name="idreserva", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idreserva;

    /**
     * @var \Asiento
     *
     * @ORM\ManyToOne(targetEntity="Asiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="asiento_idAsiento", referencedColumnName="idAsiento")
     * })
     */
    private $asientoIdasiento;

    /**
     * @var \Horario
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Horario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="horario_idHorario", referencedColumnName="idHorario")
     * })
     */
    private $horarioIdhorario;

    public function getIdreserva(): ?int
    {
        return $this->idreserva;
    }

    public function getAsientoIdasiento(): ?Asiento
    {
        return $this->asientoIdasiento;
    }

    public function setAsientoIdasiento(?Asiento $asientoIdasiento): self
    {
        $this->asientoIdasiento = $asientoIdasiento;

        return $this;
    }

    public function getHorarioIdhorario(): ?Horario
    {
        return $this->horarioIdhorario;
    }

    public function setHorarioIdhorario(?Horario $horarioIdhorario): self
    {
        $this->horarioIdhorario = $horarioIdhorario;

        return $this;
    }


}
