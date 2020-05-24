<?php

namespace App\Repository;

use App\Entity\NommenclatureEtat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NommenclatureEtat|null find($id, $lockMode = null, $lockVersion = null)
 * @method NommenclatureEtat|null findOneBy(array $criteria, array $orderBy = null)
 * @method NommenclatureEtat[]    findAll()
 * @method NommenclatureEtat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NommenclatureEtatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NommenclatureEtat::class);
    }

	public function getChoices()
	{
		return $this->getChoicesQB()->getQuery()->getResult();
	}
	
	public function getChoicesQB()
	{
		
		$qb = $this->createQueryBuilder('c');
 
		$qb->where('c.valide = 1');
		
		return $qb;
	}
	
    // /**
    //  * @return NommenclatureEtat[] Returns an array of NommenclatureEtat objects
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
    public function findOneBySomeField($value): ?NommenclatureEtat
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
