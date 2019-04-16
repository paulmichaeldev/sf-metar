<?php

namespace App\Repository;

use App\Entity\Metar;
use App\Entity\MetarCloudLayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MetarCloudLayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method MetarCloudLayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method MetarCloudLayer[]    findAll()
 * @method MetarCloudLayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetarCloudLayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MetarCloudLayer::class);
    }

    // /**
    //  * @return MetarCloudLayer[] Returns an array of MetarCloudLayer objects
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
    public function findOneBySomeField($value): ?MetarCloudLayer
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function createLayer(Metar $metar, $skyCover, $cloudBase)
    {
        if (empty($skyCover)) {
            return null;
        }

        
    }
}
