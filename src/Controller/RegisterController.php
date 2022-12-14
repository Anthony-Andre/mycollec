<?php

namespace App\Controller;

use App\Entity\Collec;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/inscription', name: 'app_register')]


    public function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {

        $user = new User();
        $collec = new Collec();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);


            $this->entityManager->persist($user);
            $this->entityManager->flush();
            $collec->setUser($user);
            $this->entityManager->persist($collec);
            $this->entityManager->flush();
            dd($collec);
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
