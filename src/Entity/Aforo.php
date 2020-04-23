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
     * @ORM\Column(name="tamanio", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tamanio;

    public function getTamanio(): ?int
    {
        return $this->tamanio;
    }

    public function __toString()
    {
        return $this->tamanio;
    }
}
