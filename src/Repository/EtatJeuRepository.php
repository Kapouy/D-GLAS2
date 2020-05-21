<?php

namespace App\Repository;

use App\Entity\EtatJeu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EtatJeu|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtatJeu|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtatJeu[]    findAll()
 * @method EtatJeu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatJeuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtatJeu::class);
    }

    // /**
    //  * @return EtatJeu[] Returns an array of EtatJeu objects
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
    public function findOneBySomeField($value): ?EtatJeu
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
