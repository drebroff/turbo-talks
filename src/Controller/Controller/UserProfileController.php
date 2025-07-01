<?php

namespace App\Controller\Controller;

use App\Entity\User;
use App\Form\UserEditForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserProfileController extends AbstractController
{
    #[Route('/profile/{id}',
        name: 'app_user_profile'
    )]
    public function index(
        User $user,
        Request $request,
    ): Response
    {

        return $this->render('user_profile/index.html.twig', [
            'controller_name' => 'UserProfileController',
            'user_email' => $user->getEmail(),
            'user_roles' => implode(', ',$user->getRoles()),

        ]);
    }
    #[Route('/admin/user/{id}/edit', name: 'user_edit')]
    // check for "edit" access: calls all voters
//    #[IsGranted('edit', 'message')]
    public function edit(
        Request $request,
        User $user,
        EntityManagerInterface $entityManager
    ): Response
    {
        $languages = $request->getLanguages();         // Provides user languages from browser
        $a = 123;
        $email = $user->getEmail();
        $id = $user->getId();
        $user_name = $user->getName();
        $user_birthday = $user->getBirthday();
//        $created_at = $user->getCreatedAt();
        $form = $this->createForm(UserEditForm::class, [
            'email' => $email ?? 'special',
            'birthday' => $user_birthday ?? new \DateTime()

//            'created_at' => $created_at
        ]);

        // Handle the request (form submission)
        $form->handleRequest($request);

        // Check if the form was submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
//            $user = new Message();
            $user->setEmail($data['email'] ?? 'special');
            $user->setBirthday($data['birthday']);
//            $user->setCreatedAt($data['created_at'] ?? 'special');

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_edit', ['id' => $user->getId()]);
        }

        return $this->render('user_profile/user_edit.html.twig', [
            'user_id' => $id,
            'user_name' => $user_name,
            'form' => $form,
            'user_birthday' => $user_birthday,
        ]);
    }
}
