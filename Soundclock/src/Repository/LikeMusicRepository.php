<?php

namespace App\Repository;

use App\Entity\LikeMusic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LikeMusic>
 *
 * @method LikeMusic|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikeMusic|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikeMusic[]    findAll()
 * @method LikeMusic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikeMusicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LikeMusic::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(LikeMusic $entity, bool $flush = false): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(LikeMusic $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

//    /**
//     * @return LikeMusic[] Returns an array of LikeMusic objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LikeMusic
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
