<?php

namespace App\Repository;

use App\Entity\Pelicula;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Peliculas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Peliculas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Peliculas[]    findAll()
 * @method Peliculas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeliculasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pelicula::class);
    }

    // /**
    //  * @return Peliculas[] Returns an array of Peliculas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Peliculas
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function trailer()
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery(
            'select p.trailer, p.titulo, p.imagen, p.idpelicula from App\Entity\Pelicula p'
        );
        return $consulta->getResult();
    }
}
