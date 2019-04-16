<?php

namespace App\Repository;

use App\Entity\Metar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Metar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Metar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Metar[]    findAll()
 * @method Metar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetarRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Metar::class);
    }

    // /**
    //  * @return Metar[] Returns an array of Metar objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Metar
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
