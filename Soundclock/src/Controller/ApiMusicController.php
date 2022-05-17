<?php

namespace App\Controller;

use App\Entity\Music;
use App\Entity\MusicLike;
use App\Entity\User;
use App\Models\JsonError;
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
    private $security;

    public function __construct(Security $security)
    {
       $this->security = $security;
    }

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
    *
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

        // dd($user);
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
        // dd($request);
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
     * @Route("/api/music/top10/like", name="api_music_top10_like", methods={"GET"})
     */
    public function listTop10ByLike(MusicRepository $musicRepository): Response
    {
        $top10ByLike = $musicRepository->findTop10ByLike();
        // dd($top10ByLike);

        return $this->json(
            $top10ByLike,
            200,
            [],
            ['groups'=> ['list_music']]
        );
    }

    /**
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
     * @Route("/api/secure/music/{id}/like", name="api_music_like_by_user", methods={"GET","POST"})
     */
    public function musicLiked(Music $music, EntityManagerInterface $entityManager,MusicLikeRepository $musicLikeRepository){

        $like = new MusicLike();

        if ($this->getUser() !== null){
            $like->setMusicLiked($music);

            $like->setUserWhoLikeMusic($this->getUser());
    
            $entityManager->persist($like);
            $entityManager->flush();
        }

        

        return $this->json(
            [$like,
            'nbLikes' => $musicLikeRepository->count(['musicLiked' => $music])],
            200,
            [],
            ['groups' => ['show_music_like']]

        );
    }

    // /**
    //  * @Route("/api/music/{id}/like", name="api_music_total_music_like", methods={"GET"})
    //  */
    // public function totalMusicLiked(Music $music,MusicLike $musicLike, MusicLikeRepository $musicLikeRepository){
    
    // return $this->json(
    //     ['nbLikes' => $musicLikeRepository->count(['musicLiked' => $music]) ],
    //     200,
    // );
    
    // }

}
