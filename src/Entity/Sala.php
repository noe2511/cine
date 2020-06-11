<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sala
 *
 * @ORM\Table(name="sala")
 * @ORM\Entity
 */
class Sala
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSala", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsala;

    /**
     * @var int
     *
     * @ORM\Column(name="aforo", type="integer", nullable=false)
     */
    private $aforo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Pelicula", inversedBy="salaIdsala")
     * @ORM\JoinTable(name="sala_has_pelicula",
     *   joinColumns={
     *     @ORM\JoinColumn(name="sala_idSala", referencedColumnName="idSala")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="pelicula_idPelicula", referencedColumnName="idPelicula")
     *   }
     * )
     */
    private $peliculaIdpelicula;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->peliculaIdpelicula = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdsala(): ?int
    {
        return $this->idsala;
    }

    public function getAforo(): ?int
    {
        return $this->aforo;
    }

    public function setAforo(int $aforo): self
    {
        $this->aforo = $aforo;

        return $this;
    }

    /**
     * @return Collection|Pelicula[]
     */
    public function getPeliculaIdpelicula(): Collection
    {
        return $this->peliculaIdpelicula;
    }

    public function addPeliculaIdpelicula(Pelicula $peliculaIdpelicula): self
    {
        if (!$this->peliculaIdpelicula->contains($peliculaIdpelicula)) {
            $this->peliculaIdpelicula[] = $peliculaIdpelicula;
        }

        return $this;
    }

    public function removePeliculaIdpelicula(Pelicula $peliculaIdpelicula): self
    {
        if ($this->peliculaIdpelicula->contains($peliculaIdpelicula)) {
            $this->peliculaIdpelicula->removeElement($peliculaIdpelicula);
        }

        return $this;
    }

    public function __toString()
    {
        return strval($this->idsala);
    }
}
