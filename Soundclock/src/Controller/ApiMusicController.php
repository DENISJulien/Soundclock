<?php

namespace App\Controller;

use App\Entity\Music;
use App\Entity\MusicDislike;
use App\Entity\MusicLike;
use App\Entity\User;
use App\Models\JsonError;
use App\Repository\MusicDislikeRepository;
use App\Repository\MusicLikeRepository;
use App\Repository\MusicRepository;
use App\Repository\UserRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class ApiMusicController extends AbstractController
{

    /**
     * @Route("/api/music", name="api_music", methods={"GET"})
     */
    public function listMusic(MusicRepository $musicRepository): Response
    {
        return $this->json(
            $musicRepository->findAll(),
            200,
            [],
            ['groups'=> ['list_music']]
        );
    }

    /**
     * @Route("api/music/{id}", name="api_music_id", methods={"GET"})
     */
    public function showMusic(Music $music): Response
    {
        if ($music === null){
            $error = new JsonError(Response::HTTP_NOT_FOUND, Music::class . 'non trouvé');
            return $this->json($error, $error->getError());
        }

        return $this->json(
            $music,
            Response::HTTP_OK,
            [],
            ['groups' => ['show_music']]
        );
    }

    /**
     * @Route("/api/music/slug/{slug_music}", name="api_music_slug", methods={"GET"})
     */
    public function showMusicBySlug(Music $music = null)
    {
        if ($music === null){
            $error = new JsonError(Response::HTTP_NOT_FOUND, Music::class . ' non trouvé');
            return $this->json($error, $error->getError());
        }

        return $this->json(
            $music,
            Response::HTTP_OK,
            [],
            ['groups' => 'show_music']
        );
    }

    /**
     * @Route("/api/secure/music/create", name="api_music_create", methods={"POST"})
     */
    public function createMusic(EntityManagerInterface $entityManager, Request $request, ValidatorInterface $validator, UserRepository $userRepository)
    {        
        $musicEntity = new Music();
        // dd($request);
        $musicEntity->setNameMusic($request->request->get('name_music'));
        $musicEntity->setDescriptionMusic($request->request->get('description_music'));
        $date = new DateTime($request->request->get('releasedate_music'));
        //dump($date);
        $musicEntity->setReleasedateMusic($date);
        $musicEntity->setStatusMusic(1);
        $musicEntity->setCreatedAtMusic(new DateTimeImmutable('now'));

        $trueUser = $userRepository->find($request->request->get('user'));

        $musicEntity->addUser($trueUser);

        $upload = $request->files;

        foreach ($upload as $key => $uploadFile)
        {
            $uploadedName = md5(uniqid()) . '.' . $uploadFile->guessExtension();

            if($key === 'picture_music'){
                $errors = $validator->validate($uploadFile, new Image([]));
                if (count($errors) > 0) {

                    $myJsonError = new JsonError(Response::HTTP_UNPROCESSABLE_ENTITY, "Des erreurs de validation ont été trouvées");
                    $myJsonError->setValidationErrors($errors);
            
                    return $this->json($myJsonError, $myJsonError->getError());
                }
            } else {
                // dd($validator->validate($uploadFile, new File(['mimeTypes' => 'audio/*'])));
                $errors = $validator->validate($uploadFile, new File(['mimeTypes' => 'audio/*']));
                if (count($errors) > 0) {

                    $myJsonError = new JsonError(Response::HTTP_UNPROCESSABLE_ENTITY, "Des erreurs de validation ont été trouvées");
                    $myJsonError->setValidationErrors($errors);
            
                    return $this->json($myJsonError, $myJsonError->getError());
                }
            }
            
            $uploadFile->move(
                $this->getParameter('upload_directory'),
                $uploadedName
            );
            if($key === 'picture_music'){
                $musicEntity->setPictureMusic($uploadedName);
            } else {
                $musicEntity->setFileMusic($uploadedName);
            }
        }
        
        $entityManager->persist($musicEntity);
        $entityManager->flush();

        return $this->json(
            [],
            Response::HTTP_CREATED,
            [],
            ['groups' => ['show_music']]
        );
    }

    /**
     * @Route("/api/secure/music/edit/{id}", name="api_music_edit", methods={"POST"})
     */
    public function updateMusic(EntityManagerInterface $entityManager, Music $music, Request $request,ValidatorInterface $validator)
    {        
        if ($request->request->get('name_music')!== null) {
            $music->setNameMusic($request->request->get('name_music'));
        }
        if ($request->request->get('description_music')!== null) {
            $music->setDescriptionMusic($request->request->get('description_music'));
        }
        if ($request->request->get('releasedate_music')!== null) {
            $date = new DateTime($request->request->get('releasedate_music'));
            $music->setReleasedateMusic($date);
        }
        if ($request->request->get('status_music')!== null) {
            $music->setStatusMusic($request->request->get('status_music'));
        }
        $music->setUpdatedAtMusic(new DateTime('now'));

        if ($request->files!== null) {

            $upload = $request->files;
            // dd ($upload);
            foreach ($upload as $key => $uploadFile)
            {
                $uploadedName = md5(uniqid()) . '.' . $uploadFile->guessExtension();
                
                if($key === 'picture_music'){
                    $errors = $validator->validate($uploadFile, new Image([]));
                    if (count($errors) > 0) {

                        $myJsonError = new JsonError(Response::HTTP_UNPROCESSABLE_ENTITY, "Des erreurs de validation ont été trouvées");
                        $myJsonError->setValidationErrors($errors);
                
                        return $this->json($myJsonError, $myJsonError->getError());
                    }
                } else {
                    // dd($validator->validate($uploadFile, new File(['mimeTypes' => 'audio/*'])));
                    $errors = $validator->validate($uploadFile, new File(['mimeTypes' => 'audio/*']));
                    if (count($errors) > 0) {

                        $myJsonError = new JsonError(Response::HTTP_UNPROCESSABLE_ENTITY, "Des erreurs de validation ont été trouvées");
                        $myJsonError->setValidationErrors($errors);
                
                        return $this->json($myJsonError, $myJsonError->getError());
                    }
                }

                $uploadFile->move(
                    $this->getParameter('upload_directory'),
                    $uploadedName
                );
                if($key === 'picture_music'){
                    $music->setPictureMusic($uploadedName);
                } else {
                    $music->setFileMusic($uploadedName);
                }
            }
        }
        
        $entityManager->persist($music);
        $entityManager->flush();

        return $this->json(
            [],
            201,
            [],
            ['groups' => ['show_music']]
        );
    }

    /**
     * Top 10 musique liké
     * @Route("/api/music/top10/like", name="api_music_top10_like", methods={"GET"})
     */
    public function listTop10ByLike(MusicRepository $musicRepository): Response
    {
        $top10ByLike = $musicRepository->findTop10ByLike();

        return $this->json(
            $top10ByLike,
            200,
            [],
            ['groups'=> ['list_music']]
        );
    }

    /**
     * Top 10 musique ecouté
     * @Route("/api/music/top10/listened", name="api_music_top10_listened", methods={"GET"})
     */
    public function listTop10ByListened(MusicRepository $musicRepository): Response
    {
        $top10ByListened = $musicRepository->findTop10ByListened();

        return $this->json(
            $top10ByListened,
            200,
            [],
            ['groups'=> ['list_music']]
        );
    }

    /**
     * Ajout d'un like à une musique
     * @Route("/api/secure/music/{id}/like", name="api_music_like_by_user", methods={"GET","POST"})
     */
    public function musicLiked(Music $music, EntityManagerInterface $entityManager,MusicLikeRepository $musicLikeRepository){

        $user = $this->getUser();

        if (!$user) return $this->json([
            'code' => 403,
            'message' => "Unauthorized"
        ],
        403);

        if($music->isLikedByUser($user)) {
            $like = $musicLikeRepository->findOneBy([
                'musicLiked' => $music,
                'userWhoLikeMusic' => $user
            ]);

            $entityManager->remove($like);
            $entityManager->flush();

            $music->setNblikeMusic($musicLikeRepository->count(['musicLiked' => $music]));
            $entityManager->persist($music);
            $entityManager->flush();

            return $this->json([
                'nbLikeMusic' => $musicLikeRepository->count(['musicLiked' => $music])],
            200,
            );
        }
        
        $like = new MusicLike(); 
        $like->setMusicLiked($music);
        $like->setUserWhoLikeMusic($user);

        $entityManager->persist($like);
        $entityManager->flush();

        $music->setNblikeMusic($musicLikeRepository->count(['musicLiked' => $music]));
        
        $entityManager->persist($music);
        $entityManager->flush();
        
        return $this->json(
            [$like,
            'nbLikeMusic' => $musicLikeRepository->count(['musicLiked' => $music])],
            200,
            [],
            ['groups' => ['show_music_like']]

        );
    }

    /**
     * Ajout d'un dislike à une musique
     * @Route("/api/secure/music/{id}/dislike", name="api_music_dislike_by_user", methods={"GET","POST"})
     */
    public function musicDisliked(Music $music, EntityManagerInterface $entityManager,MusicDislikeRepository $musicDislikeRepository){

        $user = $this->getUser();

        if (!$user) return $this->json([
            'code' => 403,
            'message' => "Unauthorized"
        ],
        403);

        if($music->isDislikedByUser($user)) {
            $dislike = $musicDislikeRepository->findOneBy([
                'musicDisliked' => $music,
                'userWhoDislikeMusic' => $user
            ]);

            $entityManager->remove($dislike);
            $entityManager->flush();

            $music->setNbdislikeMusic($musicDislikeRepository->count(['musicDisliked' => $music]));
            $entityManager->persist($music);
            $entityManager->flush();

            return $this->json([
                'nbDislikeMusic' => $musicDislikeRepository->count(['musicDisliked' => $music])],
            200,
            );
        }
        
        $dislike = new MusicDislike();
        $dislike->setMusicDisliked($music);
        $dislike->setUserWhoDislikeMusic($user);

        $entityManager->persist($dislike);
        $entityManager->flush();

        $music->setNblikeMusic($musicDislikeRepository->count(['musicDisliked' => $music]));
        
        $entityManager->persist($music);
        $entityManager->flush();
        
        return $this->json(
            [$dislike,
            'nbDislikeMusic' => $musicDislikeRepository->count(['musicDisliked' => $music])],
            200,
            [],
            ['groups' => ['show_music_dislike']]
        );
    }

    /**
     * Liste de musique like par un utilisateur
     * @Route("/api/music/user/like", name="api_list_music_user_like", methods={"POST"})
     */
    public function musicLikedByUser(MusicLikeRepository $musicLikeRepository,Request $request){

        $userWhoLikeMusic = $request->getcontent();
        $userWhoLikeMusicDecoded = json_decode($userWhoLikeMusic);

        $userWhoLikeMusicResult = $userWhoLikeMusicDecoded->idUserWhoLikeMusic;

        return $this->json(
            $musicLikeRepository->findAllMusicLikedByUser($userWhoLikeMusicResult),
            200
        );
    }

    /**
     * Liste de musique dislike par un utilisateur
     * @Route("/api/music/user/dislike", name="api_list_music_user_dislike", methods={"POST"})
     */
    public function musicDislikedByUser(MusicDislikeRepository $musicDislikeRepository,Request $request){

        $userWhoDislikeMusic = $request->getcontent();
        $userWhoDislikeMusicDecoded = json_decode($userWhoDislikeMusic);

        $userWhoDislikeMusicResult = $userWhoDislikeMusicDecoded->idUserWhoDislikeMusic;

        return $this->json(
            $musicDislikeRepository->findAllMusicDislikedByUser($userWhoDislikeMusicResult),
            200
        );
    }

    /**
     * Ajout +1 du nombre d'ecoute
     * @Route("/api/music/{id}/listen", name="api_music_listen", methods={"POST"})
     */
    public function musicListen(Music $music,EntityManagerInterface $entityManager){

        $currentListen = $music->getNblistenedMusic();
        $listen = $music->setNblistenedMusic (++ $currentListen);

        $entityManager->persist($listen);
        $entityManager->flush();

        return $this->json(
            $listen,
            200,
            [],
            ['groups' => ['show_music']]
        );
    }

}
