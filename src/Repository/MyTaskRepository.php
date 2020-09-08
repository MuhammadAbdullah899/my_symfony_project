<?php

namespace App\Repository;

use App\Entity\MyTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MyTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyTask[]    findAll()
 * @method MyTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyTaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyTask::class);
    }

    // /**
    //  * @return MyTask[] Returns an array of MyTask objects
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
    public function findOneBySomeField($value): ?MyTask
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
