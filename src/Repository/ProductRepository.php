<?php

namespace App\Repository;

use App\Entity\Product;
use App\SearchClasses\VspColorFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function add(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function filterVspColor(VspColorFilter $colorFilter)
    {
        $query = $this->createQueryBuilder('p')
            ->select('c', 'p')
            ->join('p.VspColor', 'c');

        if (!empty($colorFilter->coloris)) {

            $query = $query->andWhere('p.VspColor IN (:color)')
                ->setParameter('color', $colorFilter->coloris);
        }
        return $query->getQuery()->getResult();
    }

    public function findProductsByCategory($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.category = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }
}
