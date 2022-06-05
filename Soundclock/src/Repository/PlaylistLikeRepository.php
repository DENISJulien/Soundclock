<?php

namespace App\Repository;

use App\Entity\PlaylistLike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlaylistLike>
 *
 * @method PlaylistLike|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlaylistLike|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlaylistLike[]    findAll()
 * @method PlaylistLike[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaylistLikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaylistLike::class);
    }

    public function add(PlaylistLike $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PlaylistLike $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllPlaylistLikedByUser($id)
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "
        SELECT playlist.id AS id_playlist , name_playlist, picture_playlist
        FROM playlist_like
        JOIN playlist ON playlist_like.playlist_liked_id = playlist.id
        WHERE user_who_like_playlist_id = '$id' ";

        $results = $conn->executeQuery($sql);
        return $results->fetchAllAssociative();
    }

//    /**
//     * @return PlaylistLike[] Returns an array of PlaylistLike objects
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

//    public function findOneBySomeField($value): ?PlaylistLike
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
