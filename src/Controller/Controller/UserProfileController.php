<?php

namespace App\Controller\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserProfileController extends AbstractController
{
    #[Route('/profile/{id}',
        name: 'app_user_profile'
    )]
    public function index(
        User $user
    ): Response
    {
        return $this->render('user_profile/index.html.twig', [
            'controller_name' => 'UserProfileController',
            'user_email' => $user->getEmail(),
            'user_roles' => implode(', ',$user->getRoles()),

        ]);
    }
}
