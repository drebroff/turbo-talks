<?php
// src/Controller/SecurityController.php

namespace App\Controller\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(
        #[CurrentUser] ?User $user,
        Request $request,
        AuthenticationUtils $authenticationUtils
    ): Response
    {
        if ($user) {
            $user_roles = $user->getRoles();
            $a = 123;
        }
        // Get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // Last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $response = $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);

        // Handle Turbo streams for failed authentication
        if ($error && $this->isTurboFrame()) {
            $response->headers->set('Turbo-Frame', 'login_form');
        }

        return $response;
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        // This method can be empty - it will be intercepted by the logout key on your firewall
    }

    private function isTurboFrame(): bool
    {
        return $this->container->get('request_stack')->getCurrentRequest()->headers->has('Turbo-Frame');
    }
}