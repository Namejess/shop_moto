<?php

namespace App\Repository;

use App\Entity\Motos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Motos>
 *
 * @method Motos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Motos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Motos[]    findAll()
 * @method Motos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MotosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Motos::class);
    }

    public function save(Motos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Motos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Motos[] Returns an array of Motos objects
     */
    public function findByExampleField($value): array
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.Titre = :val')
            ->orWhere('m.Description = :val')
            ->setParameter('val', '%' . $value . '/%')
            //    ->orderBy('m.id', 'ASC')
            //    ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    //    public function findOneBySomeField($value): ?Motos
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
