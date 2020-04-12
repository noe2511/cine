<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entrada
 *
 * @ORM\Table(name="entrada", indexes={@ORM\Index(name="fk_Sala_has_Pelicula_Asiento1_idx", columns={"Asiento_idAsiento"}), @ORM\Index(name="fk_Sala_has_Pelicula_Pelicula1_idx", columns={"Pelicula_idPelicula"}), @ORM\Index(name="fk_Sala_has_Pelicula_Sala1_idx", columns={"Sala_idSala"})})
 * @ORM\Entity
 */
class Entrada
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Hora_inicio", type="time", nullable=false)
     */
    private $horaInicio;

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
     * @var \Pelicula
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Pelicula")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Pelicula_idPelicula", referencedColumnName="idPelicula")
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
     *   @ORM\JoinColumn(name="Sala_idSala", referencedColumnName="idSala")
     * })
     */
    private $salaIdsala;

    public function getHoraInicio(): ?\DateTimeInterface
    {
        return $this->horaInicio;
    }

    public function setHoraInicio(\DateTimeInterface $horaInicio): self
    {
        $this->horaInicio = $horaInicio;

        return $this;
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

    public function getPeliculaIdpelicula(): ?Pelicula
    {
        return $this->peliculaIdpelicula;
    }

    public function setPeliculaIdpelicula(?Pelicula $peliculaIdpelicula): self
    {
        $this->peliculaIdpelicula = $peliculaIdpelicula;

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
