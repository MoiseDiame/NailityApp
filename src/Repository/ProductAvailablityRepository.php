<?php

namespace App\Repository;

use App\Entity\ProductAvailablity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductAvailablity>
 *
 * @method ProductAvailablity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductAvailablity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductAvailablity[]    findAll()
 * @method ProductAvailablity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductAvailablityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductAvailablity::class);
    }

    public function add(ProductAvailablity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProductAvailablity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ProductAvailablity[] Returns an array of ProductAvailablity objects
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

//    public function findOneBySomeField($value): ?ProductAvailablity
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
