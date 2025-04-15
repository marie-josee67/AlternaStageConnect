<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Alternance;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Alternance>
 */
class AlternanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Alternance::class);
    }
    public function findAllowed(User $user): array
    {
        // retourne toutes les photos dont l'utilisateur $user a accès
        return $this->createQueryBuilder('p')
            ->andWhere('p.createdBy = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }
    //    /**
    //     * @return Alternance[] Returns an array of Alternance objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Alternance
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

}
