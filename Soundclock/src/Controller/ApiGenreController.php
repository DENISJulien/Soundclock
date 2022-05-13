<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Models\JsonError;
use App\Repository\GenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiGenreController extends AbstractController
{
    /**
     * @Route("/api/genre", name="api_genre", methods={"GET"})
     */
    public function listGenre(GenreRepository $genreRepository): Response
    {
        return $this->json(
            $genreRepository->findAll(),
            200,
            [],
            ['groups'=> ['list_genre']]
        );
    }

    /**
     * @Route("api/genre/{id}", name="api_genre_id", methods={"GET"})
     */
    public function showGenre(Genre $genre): Response
    {
        if ($genre === null){
            $error = new JsonError(Response::HTTP_NOT_FOUND, Genre::class . 'non trouvé');
            return $this->json($error, $error->getError());
        }

        return $this->json(
            $genre,
            Response::HTTP_OK,
            [],
            ['groups' => ['show_genre']]
        );
    }
    
}
