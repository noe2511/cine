<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Horario
 *
 * @ORM\Table(name="horario", indexes={@ORM\Index(name="fk_Horario_sala1_idx", columns={"sala_idSala"}), @ORM\Index(name="fk_Horario_pelicula1_idx", columns={"pelicula_idPelicula"})})
 * @ORM\Entity
 */
class Horario
{
    /**
     * @var int
     *
     * @ORM\Column(name="idHorario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idHorario;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaInicio", type="time", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $horainicio;

    /**
     * @var \Pelicula
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Pelicula")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pelicula_idPelicula", referencedColumnName="idPelicula")
     * })
     */
    private $peliculaIdpelicula;

    /**
     * @var \Sala
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Sala")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sala_idSala", referencedColumnName="idSala")
     * })
     */
    private $salaIdsala;

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }


    public function getHorainicio(): ?\DateTimeInterface
    {
        return $this->horainicio;
    }

    public function setHorainicio(\DateTimeInterface $horainicio): self
    {
        $this->horainicio = $horainicio->format('H:i:s');

        return $this;
    }

    public function getPeliculaIdpelicula()
    {
        return $this->peliculaIdpelicula;
    }

    public function setPeliculaIdpelicula(?Pelicula $peliculaIdpelicula): self
    {
        $this->peliculaIdpelicula = $peliculaIdpelicula;

        return $this;
    }

    public function getSalaIdsala()
    {
        return $this->salaIdsala;
    }

    public function setSalaIdsala(?Sala $salaIdsala): self
    {
        $this->salaIdsala = $salaIdsala;

        return $this;
    }

    public function __toString()
    {
        return $this->fecha;
    }
}
