<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RateController extends AbstractController
{
    #[Route('/rate', name: 'app_rate')]
    public function index(): Response
    {
        return new Response(content : "Les Films les plus aimé", status: 200);
    }

    #[Route('/rate/movie/{id}+{rate}',
    name: 'app_rate_movie',
    requirements:['id'=>'\d+', 'rate'=>'\d+']
    )]
    public function Ratedmovie(int $id, int $rate): Response
    {
        return new Response(content : "Like du film choisi", status: 200);
    }
}
