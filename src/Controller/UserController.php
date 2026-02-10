<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

#[IsGranted('ROLE_ADMIN')]
final class UserController extends AbstractController
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher) {}
    
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    public function registration(EntityManagerInterface $em)
    {
        $user = new User();
        $plainPassword = $user->getPassword();

        $hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);
        $user->setPassword($hashedPassword);

        $em->persist($user);
        $em->flush();
    } 

    public function delete(UserPasswordHasherInterface $passwordHasher, User $user): void
    {
        $plaintextPassword = $user->getPassword();

        if (!$passwordHasher->isPasswordValid($user, $plaintextPassword)) {
            throw new AccessDeniedHttpException();
        }
    }
    
}
