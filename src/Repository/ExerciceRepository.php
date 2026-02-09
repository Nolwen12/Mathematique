<?php

namespace App\Repository;

use App\Entity\Exercice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Exercice>
 */
class ExerciceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exercice::class);
    }

    public function findByChapitre($chapitreId): mixed
    {
        return $this->createQueryBuilder('e')
            ->leftJoin('e.chapitre', 'c')
            ->where('e.id = :chapitreId')
            ->setParameter('chapitreId', $chapitreId)
            ->getQuery()
            ->getResult();
    }

    public function findByExercice($exerciceId): mixed
    {
        return $this->createQueryBuilder('e')
            ->leftJoin('e.correction', 'c')
            ->where('e.id = :correctionId')
            ->setParameter('correctionId', $exerciceId)
            ->getQuery()
            ->getResult();
    }
    
    //    /**
    //     * @return Exercice[] Returns an array of Exercice objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Exercice
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
