<?php

namespace App\Controller;

use App\Entity\VideoGame;
use App\Form\VideoGameType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegisterVideoGameController extends AbstractController
{


    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/enregistrer-jeu-video', name: 'app_register_video_game')]
    public function index(Request $request): Response
    {

        $videoGame = new VideoGame();
        $user = $this->getUser();

        $form = $this->createForm(VideoGameType::class, $videoGame);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $videoGame = $form->getData();
            $this->entityManager->persist($videoGame);
            $this->entityManager->flush();
        }


        return $this->render('register_video_game/index.html.twig', [
            'controller_name' => 'RegisterVideoGameController',
            'form' => $form->createView()
        ]);
    }
}
