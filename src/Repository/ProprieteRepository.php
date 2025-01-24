<?php

namespace App\Repository;

use App\Entity\Propriete;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Propriete>
 */
class ProprieteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Propriete::class);
    }

    public function findAllVisible(){
        return $this->findVisibleQuery()
                    -> where('p.sold = false')
                    ->getQuery()
                    ->getResult();
    }

    public function findLatest(): array
    {
        return $this->findVisibleQuery()
            -> where('p.sold = false')
            ->setMaxResults(4)
            ->orderBy('p.created_at', 'DESC')
            ->getQuery()
            ->getResult();
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
                    -> where('p.sold = false');
    }

    //    /**
    //     * @return Propriete[] Returns an array of Propriete objects
    //     */
    //    public function findByExampleField($value): array
    //    {
        //    return $this->createQueryBuilder('p')
        //        ->andWhere('p.exampleField = :val')
        //        ->setParameter('val', $value)
        //        ->orderBy('p.id', 'ASC')
        //        ->setMaxResults(10)
        //        ->getQuery()
        //        ->getResult()
        //    ;
    //    }

    //    public function findOneBySomeField($value): ?Propriete
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
