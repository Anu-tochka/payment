<?php

namespace App\Repository;

use App\Entity\Pers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pers>
 *
 * @method Pers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pers[]    findAll()
 * @method Pers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pers::class);
    }

    public function save(Pers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Pers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

	public function findAllPersonal(): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT p.id as persID, p.fam, p.im, p.ot, p.dr, p.passportS, p.passportN, p.passportBy, p.passportD, p.inn, p.isWork, p.employeeNum, w.workname, w.rate as rate, w.cost, w.trevelpayment, w.id as workID
            FROM App\Entity\Pers p
			JOIN p.works w
			WHERE p.isWork = 1 
            ORDER BY p.fam ASC'
        );
        return $query->getResult();
    }

//    /**
//     * @return Pers[] Returns an array of Pers objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Pers
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
