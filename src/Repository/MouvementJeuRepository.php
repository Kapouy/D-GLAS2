<?php

namespace App\Repository;

use App\Entity\MouvementJeu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MouvementJeu|null find($id, $lockMode = null, $lockVersion = null)
 * @method MouvementJeu|null findOneBy(array $criteria, array $orderBy = null)
 * @method MouvementJeu[]    findAll()
 * @method MouvementJeu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MouvementJeuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MouvementJeu::class);
    }

    // /**
    //  * @return MouvementJeu[] Returns an array of MouvementJeu objects
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
    public function findOneBySomeField($value): ?MouvementJeu
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
