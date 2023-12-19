<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/movie', name: 'app_movie')]
    public function index(): Response
    {
        return $this->render(
            'movie/index.html.twig',
            [
            'controller_name' => 'MovieController',
        ]);
    }
    #[Route('/movies', name: 'app_movies')]
    public function list(): Response
    {
        return new Response(content : 'Liste des films', status: 200);
    }

    #[Route('/movies/vues', name: 'app_movies_vues')]
    public function vues(): Response
    {
        return $this->render(
            'movie/list.html.twig',
            [
                'Mavariable'=> 'Youhou ça marche',
                ]
            );
    }

    #[Route('/movie/random', name: 'app_random_movie')]
    public function random(): Response
    {
        $this->test();

        return new Response(content : 'films Aléatoire', status: 200);
    }
    #[Route(
        '/movie/{id}',
        name: 'app_movie_by_id',
        requirements: ['id' => '\d+']
    )]
    public function findOne(int $id): Response
    {
        // Récupérer l'API key de TMDB
        $themoviedbApiKey = $_ENV['TMDB_API_KEY'];
    
        // Création de l'endpoint de l'API pour rechercher un film par ID
        $endPoint = 'https://api.themoviedb.org/3/movie/' . $id . '?api_key=' . $themoviedbApiKey . '&language=fr-FR';
    
        // Lancement d'une requête HTTP
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endPoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $resultatCurl = curl_exec($ch);
        curl_close($ch);

        $movieDetails = json_decode($resultatCurl);

        if ($movieDetails && property_exists($movieDetails, 'original_title')) {
            return $this->render(
                'movie/movie.html.twig',
                [
                    'movie' => $movieDetails,
                ]
            );
        } else {
            return $this->render(
                'movie/error.html.twig',
                [
                    'message' => 'Film non trouvé ou informations incomplètes',
                ]
            );
        }
    }
}
