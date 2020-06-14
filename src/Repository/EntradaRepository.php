<?php

namespace App\Repository;

use App\Entity\Horario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class EntradaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Horario::class);
    }

    public function reservas($idHorario)
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery(
            'select e from App\Entity\Entrada e where e.horarioIdhorario=:id'
        )->setParameter(':id', $idHorario);
        return $consulta->getResult();
    }
}
