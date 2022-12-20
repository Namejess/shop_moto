<?php

namespace App\Repository;

use App\Entity\MotosPanier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MotosPanier>
 *
 * @method MotosPanier|null find($id, $lockMode = null, $lockVersion = null)
 * @method MotosPanier|null findOneBy(array $criteria, array $orderBy = null)
 * @method MotosPanier[]    findAll()
 * @method MotosPanier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MotosPanierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MotosPanier::class);
    }

    public function save(MotosPanier $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MotosPanier $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //moto by id
    public function findMotoById(int $id): ?MotosPanier
    {
        return $this->createQueryBuilder('m')
            ->andWhere('qte = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

//    /**
//     * @return MotosPanier[] Returns an array of MotosPanier objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MotosPanier
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
