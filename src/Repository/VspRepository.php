<?php

namespace App\Repository;

use App\Entity\Vsp;
use App\SearchClasses\VspColorFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vsp>
 *
 * @method Vsp|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vsp|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vsp[]    findAll()
 * @method Vsp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VspRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vsp::class);
    }

    public function add(Vsp $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Vsp $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    /**
     * Requete permettant d'afficher les coloris de vernis choisis par l'utilisateur
     * @return Vsp[] Returns an array of Vsp objects
     */
    public function filterByColor(VspColorFilter $colorFilter): array
    {
        $query = $this->createQueryBuilder('v')
            ->select('c', 'v')
            ->join('v.color', 'c');

        if (!empty($colorFilter->coloris)) {
            $query = $query->andWhere('v.color IN (:coloris)')
                ->setParameter('coloris', $colorFilter->coloris);
        }

        return $query->getQuery()->getResult();
    }

    //    public function findOneBySomeField($value): ?Vsp
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
