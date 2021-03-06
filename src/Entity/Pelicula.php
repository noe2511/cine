<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pelicula
 *
 * @ORM\Table(name="pelicula", indexes={@ORM\Index(name="fk_Pelicula_Genero1_idx", columns={"Genero_idGenero"})})
 * @ORM\Entity
 */
class Pelicula
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPelicula", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpelicula;

    /**
     * @var string
     *
     * @ORM\Column(name="Director", type="string", length=150, nullable=false)
     * @Assert\Length(
     * min = 2)
     */
    private $director;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha_estreno", type="date", nullable=false)
     */
    private $fechaEstreno;

    /**
     * @var int
     *
     * @ORM\Column(name="Duracion", type="integer", nullable=false)
     * @Assert\Positive
     */
    private $duracion;

    /**
     * @var string
     *
     * @ORM\Column(name="Descripcion", type="string", length=500, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="Actores", type="string", length=500, nullable=false)
     */
    private $actores;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=250, nullable=false)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=45, nullable=false)
     * @Assert\Length(
     * min = 2)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="trailer", type="string", length=250, nullable=false)
     */
    private $trailer;

    /**
     * @var \Genero
     *
     * @ORM\ManyToOne(targetEntity="Genero")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Genero_idGenero", referencedColumnName="idGenero")
     * })
     */
    private $generoIdgenero;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Sala", mappedBy="peliculaIdpelicula")
     */
    private $salaIdsala;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->salaIdsala = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdpelicula(): ?int
    {
        return $this->idpelicula;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(string $director): self
    {
        $this->director = $director;

        return $this;
    }

    public function getFechaEstreno(): ?\DateTimeInterface
    {
        return $this->fechaEstreno;
    }

    public function setFechaEstreno(\DateTimeInterface $fechaEstreno): self
    {
        $this->fechaEstreno = $fechaEstreno;

        return $this;
    }

    public function getDuracion(): ?int
    {
        return $this->duracion;
    }

    public function setDuracion(int $duracion): self
    {
        $this->duracion = $duracion;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getActores(): ?string
    {
        return $this->actores;
    }

    public function setActores(string $actores): self
    {
        $this->actores = $actores;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getTrailer(): ?string
    {
        return $this->trailer;
    }

    public function setTrailer(string $trailer): self
    {
        $this->trailer = $trailer;

        return $this;
    }

    public function getGeneroIdgenero()
    {
        return $this->generoIdgenero;
    }

    public function setGeneroIdgenero(?Genero $generoIdgenero): self
    {
        $this->generoIdgenero = $generoIdgenero;

        return $this;
    }

    /**
     * @return Collection|Sala[]
     */
    public function getSalaIdsala(): Collection
    {
        return $this->salaIdsala;
    }

    public function addSalaIdsala(Sala $salaIdsala): self
    {
        if (!$this->salaIdsala->contains($salaIdsala)) {
            $this->salaIdsala[] = $salaIdsala;
            $salaIdsala->addPeliculaIdpelicula($this);
        }

        return $this;
    }

    public function removeSalaIdsala(Sala $salaIdsala): self
    {
        if ($this->salaIdsala->contains($salaIdsala)) {
            $this->salaIdsala->removeElement($salaIdsala);
            $salaIdsala->removePeliculaIdpelicula($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->titulo;
    }
}
