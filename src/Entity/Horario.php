<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Horario
 *
 * @ORM\Table(name="horario", indexes={@ORM\Index(name="fk_Horario_pelicula1_idx", columns={"pelicula_idPelicula"}), @ORM\Index(name="fk_Horario_sala1_idx", columns={"sala_idSala"})})
 * @ORM\Entity
 */
class Horario
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaInicio", type="time", nullable=false)
     */
    private $horainicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var int
     *
     * @ORM\Column(name="idHorario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idhorario;

    /**
     * @var \Pelicula
     *
     * @ORM\ManyToOne(targetEntity="Pelicula")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pelicula_idPelicula", referencedColumnName="idPelicula")
     * })
     */
    private $peliculaIdpelicula;

    /**
     * @var \Sala
     *
     * @ORM\ManyToOne(targetEntity="Sala")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sala_idSala", referencedColumnName="idSala")
     * })
     */
    private $salaIdsala;

    public function getHorainicio(): ?\DateTimeInterface
    {
        return $this->horainicio;
    }

    public function setHorainicio(\DateTimeInterface $horainicio): self
    {
        $this->horainicio = $horainicio;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getIdhorario(): ?int
    {
        return $this->idhorario;
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
        return strval($this->idhorario);
    }
}
