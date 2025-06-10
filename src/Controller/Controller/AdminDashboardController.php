<?php

namespace App\Controller\Controller;

use App\Entity\Message;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\Cache;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Routing\Attribute\Route;

final class AdminDashboardController extends AbstractController
{
    #[Cache(expires: '+6000 seconds')] // Expires: Thu, 01 Mar 2011 16:00:00 GMT
    #[Route('/admin/dashboard', name: 'app_admin_dashboard')]
    public function index(EntityManagerInterface $entityManager, Request $request, HubInterface $hub): Response
    {
        $users = $entityManager->getRepository(User::class)->findBy([]);
        $a = 123;
        $user = $this->getUser();
        $messages = $entityManager->getRepository(Message::class)->findAll();;

//        $a = $this->userProvider->loadUserByIdentifier(1);
//        $c = 123;
        return $this->render('admin_dashboard/index.html.twig', [
            'controller_name' => 'AdminDashboardController',
            'users' => $users,
            'messages' => $messages,
        ]);
    }
}
