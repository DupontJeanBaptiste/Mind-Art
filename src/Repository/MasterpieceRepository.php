<?php

namespace App\Repository;

use App\Entity\Masterpiece;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Masterpiece>
 *
 * @method Masterpiece|null find($id, $lockMode = null, $lockVersion = null)
 * @method Masterpiece|null findOneBy(array $criteria, array $orderBy = null)
 * @method Masterpiece[]    findAll()
 * @method Masterpiece[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @SuppressWarnings(PHPMD)
 */
class MasterpieceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Masterpiece::class);
    }

    public function add(Masterpiece $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Masterpiece $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Masterpiece[] Returns an array of Masterpiece objects
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

//    public function findOneBySomeField($value): ?Masterpiece
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findByQueryName(?string $query): array
    {
        if (strlen($query) >= 3) {
            return $this->createQueryBuilder('m')
            ->andWhere('m.name LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->orderBy('m.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
        } else {
            return $this->findAll();
        }
    }
}
