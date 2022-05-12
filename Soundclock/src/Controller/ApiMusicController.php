<?php

namespace App\Controller;

use App\Entity\Music;
use App\Models\JsonError;
use App\Repository\MusicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * @Route("api/musics/{id}", name="api_music_id", methods={"GET"})
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
     * @Route("/api/music/{slug_music}", name="api_music_slug", methods={"GET"})
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

}
