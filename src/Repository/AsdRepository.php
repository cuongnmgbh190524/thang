<?php

namespace App\Repository;

use App\Entity\Asd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Asd|null find($id, $lockMode = null, $lockVersion = null)
 * @method Asd|null findOneBy(array $criteria, array $orderBy = null)
 * @method Asd[]    findAll()
 * @method Asd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AsdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Asd::class);
    }

    // /**
    //  * @return Asd[] Returns an array of Asd objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Asd
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
