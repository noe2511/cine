<?php

namespace App\Entity;

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


}
