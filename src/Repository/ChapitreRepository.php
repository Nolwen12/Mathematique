<?php

namespace App\Repository;

use App\Entity\Chapitre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Chapitre>
 */
class ChapitreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chapitre::class);
    }

      public function findByCategorie($categorieId): mixed
      {
        return $this->createQueryBuilder('a')
            ->leftJoin('a.categorie', 'c')
            ->where('c.id = :categorieId')
            ->setParameter('categorieId', $categorieId)
            ->getQuery()
            ->getResult();
      }

      public function search(string $criteria)
      {
        return $this->createQueryBuilder('c')
            ->where('c.title LIKE :keyword')
            ->setParameter('keyword', '%' . $criteria . '%')
            ->orderBy('c.title', 'ASC')
            ->getQuery()
            ->getResult();
      }

    //    /**
    //     * @return Chapitre[] Returns an array of Chapitre objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Chapitre
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
