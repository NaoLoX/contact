<?php

namespace App\Repository;

use App\Entity\Expediteurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Expediteurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Expediteurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Expediteurs[]    findAll()
 * @method Expediteurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpediteursRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Expediteurs::class);
    }

    // /**
    //  * @return Expediteurs[] Returns an array of Expediteurs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Expediteurs
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
