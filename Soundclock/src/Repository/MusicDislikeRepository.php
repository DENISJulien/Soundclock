<?php

namespace App\Repository;

use App\Entity\MusicDislike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MusicDislike>
 *
 * @method MusicDislike|null find($id, $lockMode = null, $lockVersion = null)
 * @method MusicDislike|null findOneBy(array $criteria, array $orderBy = null)
 * @method MusicDislike[]    findAll()
 * @method MusicDislike[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MusicDislikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MusicDislike::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(MusicDislike $entity, bool $flush = false): void
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
    public function remove(MusicDislike $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findAllMusicDislikedByUser($id)
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "
        SELECT music.id AS id_music , name_music, picture_music
        FROM music_dislike
        JOIN music ON music_dislike.music_disliked_id = music.id
        WHERE user_who_dislike_music_id = '$id' ";

        $results = $conn->executeQuery($sql);
        return $results->fetchAllAssociative();
    }

//    /**
//     * @return MusicDislike[] Returns an array of MusicDislike objects
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

//    public function findOneBySomeField($value): ?MusicDislike
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
