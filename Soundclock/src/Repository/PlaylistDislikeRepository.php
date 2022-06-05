<?php

namespace App\Repository;

use App\Entity\PlaylistDislike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlaylistDislike>
 *
 * @method PlaylistDislike|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlaylistDislike|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlaylistDislike[]    findAll()
 * @method PlaylistDislike[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaylistDislikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaylistDislike::class);
    }

    public function add(PlaylistDislike $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PlaylistDislike $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllPlaylistDislikedByUser($id)
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "
        SELECT playlist.id AS id_playlist , name_playlist, picture_playlist
        FROM playlist_dislike
        JOIN playlist ON playlist_dislike.playlist_disliked_id = playlist.id
        WHERE user_who_dislike_playlist_id = '$id' ";

        $results = $conn->executeQuery($sql);
        return $results->fetchAllAssociative();
    }

//    /**
//     * @return PlaylistDislike[] Returns an array of PlaylistDislike objects
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

//    public function findOneBySomeField($value): ?PlaylistDislike
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
