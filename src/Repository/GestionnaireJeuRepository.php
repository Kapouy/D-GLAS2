<?php

namespace App\Repository;

use App\Entity\GestionnaireJeu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GestionnaireJeu|null find($id, $lockMode = null, $lockVersion = null)
 * @method GestionnaireJeu|null findOneBy(array $criteria, array $orderBy = null)
 * @method GestionnaireJeu[]    findAll()
 * @method GestionnaireJeu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GestionnaireJeuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GestionnaireJeu::class);
    }

    // /**
    //  * @return GestionnaireJeu[] Returns an array of GestionnaireJeu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GestionnaireJeu
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
