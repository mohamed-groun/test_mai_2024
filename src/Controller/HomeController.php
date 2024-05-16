<?php

namespace App\Controller;

use App\Helper\Helper;
use App\Services\NewsApiService;
use App\Services\RssFluxService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="app_home")
     */
    public function index(NewsApiService $newsApiService, RssFluxService $rssFluxService): Response
    {
        $articles = $newsApiService->fetchData();
        $rssFlux = $rssFluxService->fetchData();

        $articlesImages = Helper::getOnlyImagesLinks($articles);
        $fluxImages = Helper::getMediaContentURLs($rssFlux);

        return $this->render('home/index.html.twig', [
            'images' => array_unique(array_merge($articlesImages, $fluxImages)),
        ]);
    }

}
