<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Rol
 *
 * @ORM\Table(name="rol")
 * @ORM\Entity
 */
class Rol
{
    /**
     * @var int
     *
     * @ORM\Column(name="idRol", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrol;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Usuario", mappedBy="rolIdrol")
     */
    private $usuarioUsuario;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuarioUsuario = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdrol(): ?int
    {
        return $this->idrol;
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

    /**
     * @return Collection|Usuario[]
     */
    public function getUsuarioUsuario(): Collection
    {
        return $this->usuarioUsuario;
    }

    public function addUsuarioUsuario(Usuario $usuarioUsuario): self
    {
        if (!$this->usuarioUsuario->contains($usuarioUsuario)) {
            $this->usuarioUsuario[] = $usuarioUsuario;
            $usuarioUsuario->addRolIdrol($this);
        }

        return $this;
    }

    public function removeUsuarioUsuario(Usuario $usuarioUsuario): self
    {
        if ($this->usuarioUsuario->contains($usuarioUsuario)) {
            $this->usuarioUsuario->removeElement($usuarioUsuario);
            $usuarioUsuario->removeRolIdrol($this);
        }

        return $this;
    }

}
