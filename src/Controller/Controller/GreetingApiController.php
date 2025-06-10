<?php

namespace App\Controller\Controller;

use App\MyBundle\Service\GreetingService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


final class GreetingApiController extends AbstractController
{
    #[Route('/api/greet/{name}', name: 'app_greeting')]
    public function index(string $name, GreetingService $greetingService): Response
    {
        $greeting = $greetingService->greet($name);

        return $this->json(['greeting' => $greeting]);

    }
}
