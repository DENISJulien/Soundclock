<?php

namespace App\Controller;

use App\Entity\Music;
use App\Models\JsonError;
use App\Repository\MusicRepository;
use App\Repository\UserRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
    *
    * @Route("/api/music/create", name="api_music_create", methods={"POST"})
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

}
