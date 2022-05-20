<?php

namespace App\Controller;

use App\Entity\Playlist;
use App\Models\JsonError;
use App\Repository\MusicRepository;
use App\Repository\PlaylistRepository;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiPlaylistController extends AbstractController
{
    /**
     * @Route("/api/playlist", name="api_playlist", methods={"GET"})
     */
    public function listPlaylist(PlaylistRepository $playlistRepository): Response
    {
        return $this->json(
            $playlistRepository->findAll(),
            200,
            [],
            ['groups'=> ['list_playlist']]
        );
    }

    /**
     * @Route("api/playlist/{id}", name="api_playlist_id", methods={"GET"})
     */
    public function showPlaylist(Playlist $playlist): Response
    {
        if ($playlist === null){
            $error = new JsonError(Response::HTTP_NOT_FOUND, Playlist::class . 'non trouvé');
            return $this->json($error, $error->getError());
        }

        return $this->json(
            $playlist,
            Response::HTTP_OK,
            [],
            ['groups' => ['show_playlist']]
        );
    }

    /**
     * @Route("api/playlist/slug/{slug_playlist}", name="api_playlist_slug", methods={"GET"})
     */
    public function showPlaylistBySlug(Playlist $playlist = null){

        if ($playlist === null){
            $error = new JsonError(Response::HTTP_NOT_FOUND, Playlist::class . ' non trouvé');
            return $this->json($error, $error->getError());
        }

        return $this->json(
            $playlist,
            Response::HTTP_OK,
            [],
            ['groups' => ['show_playlist']]
        );
    }

    /**
     * @Route("api/secure/playlist/create", name="api_playlist_create", methods={"POST"})
     */
    public function createPlaylist(MusicRepository $musicRepository, Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator){
        $playlistEntity = New Playlist();

        $upload = $request->files;

            foreach ($upload as $key => $uploadFile)
            {
                $uploadedName = md5(uniqid()) . '.' . $uploadFile->guessExtension();

                $errors = $validator->validate($uploadFile, new Image([]));

                $uploadFile->move(
                    $this->getParameter('upload_directory'),
                    $uploadedName
                );

                $playlistEntity->setPicturePlaylist($uploadedName);
            }

        $playlistEntity->setNamePlaylist($request->request->get('name_playlist'));
        $playlistEntity->setDescriptionPlaylist($request->request->get('description_playlist'));
        $playlistEntity->setAlbum($request->request->get('album'));
        $playlistEntity->setStatusPlaylist(1);
        $playlistEntity->setCreatedatPlaylist(new DateTimeImmutable('now'));
        $playlistEntity->setUser($this->getUser());
        
        $entityManager->persist($playlistEntity);
        $entityManager->flush();

        return $this->json(
            [],
            Response::HTTP_CREATED,
            [],
            ['groups' => ['show_playlist']]
        );

    }
}
