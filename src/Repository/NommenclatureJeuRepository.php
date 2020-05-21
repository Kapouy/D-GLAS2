<?php

namespace App\Repository;

use App\Entity\NommenclatureJeu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NommenclatureJeu|null find($id, $lockMode = null, $lockVersion = null)
 * @method NommenclatureJeu|null findOneBy(array $criteria, array $orderBy = null)
 * @method NommenclatureJeu[]    findAll()
 * @method NommenclatureJeu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NommenclatureJeuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NommenclatureJeu::class);
    }

    // /**
    //  * @return NommenclatureJeu[] Returns an array of NommenclatureJeu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NommenclatureJeu
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
