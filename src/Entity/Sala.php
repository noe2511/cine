<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sala
 *
 * @ORM\Table(name="sala", indexes={@ORM\Index(name="fk_Sala_Cine_idx", columns={"Cine_CIF"})})
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
     * @var \Cine
     *
     * @ORM\ManyToOne(targetEntity="Cine")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Cine_CIF", referencedColumnName="CIF")
     * })
     */
    private $cineCif;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Pelicula", inversedBy="salaIdsala")
     * @ORM\JoinTable(name="sala_has_pelicula1",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Sala_idSala", referencedColumnName="idSala")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Pelicula_idPelicula", referencedColumnName="idPelicula")
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

    public function getCineCif(): ?Cine
    {
        return $this->cineCif;
    }

    public function setCineCif(?Cine $cineCif): self
    {
        $this->cineCif = $cineCif;

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
}
