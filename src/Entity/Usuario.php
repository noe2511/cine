<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario
{
    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="contrasenia", type="string", length=45, nullable=false)
     */
    private $contrasenia;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Rol", inversedBy="usuarioUsuario")
     * @ORM\JoinTable(name="usuario_has_rol",
     *   joinColumns={
     *     @ORM\JoinColumn(name="usuario_usuario", referencedColumnName="usuario")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="rol_idRol", referencedColumnName="idRol")
     *   }
     * )
     */
    private $rolIdrol;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rolIdrol = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getUsuario(): ?string
    {
        return $this->usuario;
    }

    public function getContrasenia(): ?string
    {
        return $this->contrasenia;
    }

    public function setContrasenia(string $contrasenia): self
    {
        $this->contrasenia = $contrasenia;

        return $this;
    }

    /**
     * @return Collection|Rol[]
     */
    public function getRolIdrol(): Collection
    {
        return $this->rolIdrol;
    }

    public function addRolIdrol(Rol $rolIdrol): self
    {
        if (!$this->rolIdrol->contains($rolIdrol)) {
            $this->rolIdrol[] = $rolIdrol;
        }

        return $this;
    }

    public function removeRolIdrol(Rol $rolIdrol): self
    {
        if ($this->rolIdrol->contains($rolIdrol)) {
            $this->rolIdrol->removeElement($rolIdrol);
        }

        return $this;
    }

}
