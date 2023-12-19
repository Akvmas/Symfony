<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/user/view', name: 'app_user_visit')]
    public function View(): Response
    {
        return new Response(content : "Profil de l'utilisateur séléctionné", status: 200);
    }

    #[Route('/user/profil', name: 'app_user_profil')]
    public function Profil(): Response
    {
        return new Response(content : "Votre profil utilisateur", status: 200);
    }  
}
