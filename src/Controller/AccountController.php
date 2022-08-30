<?php

namespace App\Controller;

use App\Entity\Collec;
use App\Entity\VideoGame;
use App\Form\AddVideoGameType;
use App\Form\VideoGameType;
use App\Repository\CollecRepository;
use App\Repository\ConsoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AccountController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/ma-collec', name: 'app_account')]
    public function index(Request $request, CollecRepository $collecRepository, ConsoleRepository $consoleRepository): Response
    {
        $user = $this->getUser();
        $collec = $collecRepository->findOneByUser($user);
        $consoles = $consoleRepository->findAll();
        $form = $this->createForm(AddVideoGameType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formulaire = $form->get('video_game')->getData();
            $collec->addVideoGame($formulaire);
            $this->entityManager->persist($collec);
            $this->entityManager->flush();
        }

        $listOfVideoGames = $collec->getVideoGame()->getValues();


        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
            'form' => $form->createView(),
            'listOfVideoGames' => $listOfVideoGames,
            'consoles' => $consoles
        ]);
    }
}
