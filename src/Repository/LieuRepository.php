<?php

namespace App\Repository;

use App\Entity\Lieu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lieu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lieu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lieu[]    findAll()
 * @method Lieu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LieuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lieu::class);
    }

	public function getChoices()
	{
		$raw = $this->_em->createQuery('
			SELECT c.id, c.nom
			FROM App\Entity\Lieu c
			ORDER BY c.id ASC
		')->getResult();
		$etat = array();
		foreach ($raw as $r) {
			$key          = $r['id'];
			$etat[$key] = $r['nom'] ;
		}
		return $etat;
	}
	
	public function getDefaut()
	{
		$raw = $this->_em->createQuery('
			SELECT c
			FROM App\Entity\Lieu c
			WHERE c.defaut = 1
			ORDER BY c.id DESC
		')->getResult();
		return $raw[0];
	}
	
    // /**
    //  * @return Lieu[] Returns an array of Lieu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Lieu
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
