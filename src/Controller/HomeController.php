<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/api/check-auth', name: 'check_auth')]
    public function checkAuth(): Response
    {
        $user = $this->getUser();

        dd($user);

        if ($user === null) {
            return $this->json(['not connected']);
        } else {
            return $this->json(['connected as ' . $user->getEmail()]);
        }
    }


}
