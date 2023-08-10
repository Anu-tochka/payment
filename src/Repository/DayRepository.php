<?php

namespace App\Repository;

use App\Entity\Day;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Day>
 *
 * @method Day|null find($id, $lockMode = null, $lockVersion = null)
 * @method Day|null findOneBy(array $criteria, array $orderBy = null)
 * @method Day[]    findAll()
 * @method Day[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Day::class);
    }

    public function save(Day $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Day $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

	public function isWorkToday($today, $idList): ?array//?Day
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT d.id as did, d.daynow, p.id as pid 
            FROM App\Entity\Day d
			JOIN d.pers p 
			WHERE d.daynow = :day
			AND p.id in (:p)'
        ) 
		->setParameter('day', $today)
		->setParameter('p', $idList); 
        return $query->getResult();
    }

	public function findIndividualDay($targetDay, $persID): ?array
    {
		$entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT d.id as dayID, s.statusname, d.hours, d.kpi, d.total, d.daynow
            FROM App\Entity\Day d
			JOIN d.statuses s 
			WHERE d.daynow = :day
			AND d.pers = :p
			'
        ) 
		->setParameter('day', $targetDay)
		->setParameter('p', $persID);
        return $query->getResult();//OneOrNullResult();//getArrayResult();
    }
//    /**
//     * @return Day[] Returns an array of Day objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Day
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
