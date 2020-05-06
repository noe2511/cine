<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Aforo
 *
 * @ORM\Table(name="aforo")
 * @ORM\Entity
 */
class Aforo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="tamanio", type="integer", nullable=false)
     */
    private $tamanio;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTamanio(): ?int
    {
        return $this->tamanio;
    }

    public function setTamanio(int $tamanio): self
    {
        $this->tamanio = $tamanio;

        return $this;
    }


}
