<?php

namespace App\Controller;

use App\Entity\Banner;
use App\Models\JsonError;
use App\Repository\BannerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiBannerController extends AbstractController
{
    /**
     * @Route("/api/banner", name="api_banner", methods={"GET"})
     */
    public function listBanner(BannerRepository $bannerRepository): Response
    {
        return $this->json(
            $bannerRepository->findAll(),
            200,
            [],
            ['groups'=> ['list_banner']]
        );
    }

    /**
     * @Route("/api/banner/{id}", name="api_banner_id", methods={"GET"})
     */
    public function showBanner(Banner $banner = null)
    {
        if ($banner === null){
            $error = new JsonError(Response::HTTP_NOT_FOUND, Banner::class . ' non trouvé');
            return $this->json($error, $error->getError());
        }

        return $this->json(
            $banner,
            Response::HTTP_OK,
            [],
            ['groups' => 'show_banner']
        );
    }
}
