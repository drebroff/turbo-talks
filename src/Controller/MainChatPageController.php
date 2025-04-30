<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainChatPageController extends AbstractController
{
    #[Route('/', name: 'app_main_chat_page')]
    public function index(): Response
    {
        return $this->render('main_chat_page/index.html.twig', [
            'controller_name' => 'MainChatPageController',
        ]);
    }
}
