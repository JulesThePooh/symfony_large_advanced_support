<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{


    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    #[Route('/game', name: 'app_game')]
    public function index(Request $request): Response
    {

        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($game);
            $this->entityManager->flush();
        }


        return $this->render('game/index.html.twig', [
            'controller_name' => 'GameController',
            'form' => $form->createView()
        ]);
    }
}
