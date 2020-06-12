<?php

namespace App\Repository;

use App\Entity\Horario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class HorarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Horario::class);
    }

    public function horariosPelicula($idPelicula)
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery(
            'select h from App\Entity\Horario h
            where h.peliculaIdpelicula = :id'
        )->setParameter(':id', $idPelicula);
        return $consulta->getResult();
    }
}
