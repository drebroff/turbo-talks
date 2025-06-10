<?php

namespace App\Controller\Controller;

use App\Entity\Message;
use App\Form\ChatFormType;
use App\Twig\Components\ChatForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class ChatPostController extends AbstractController
{
    #[Route('/posts/{id}', name: 'post_show')]
    // check for "view" access: calls all voters
    #[IsGranted('view', 'message')]
    public function show(Message $message): Response
    {
        // ...
    }

    #[Route('/admin/posts/{id}/edit', name: 'post_edit')]
    // check for "edit" access: calls all voters
//    #[IsGranted('edit', 'message')]
    public function edit(Request $request, Message $message ,EntityManagerInterface $entityManager
): Response
    {
        $content = $message->getContent();
        $id = $message->getId();
        $created_at = $message->getCreatedAt();
        $form = $this->createForm(ChatFormType::class, [
            'content' => $content ?? 'special',
//            'created_at' => $created_at
        ]);

        // Handle the request (form submission)
        $form->handleRequest($request);

        // Check if the form was submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
//            $message = new Message();
            $message->setContent($data['content'] ?? 'special');
//            $message->setCreatedAt($data['created_at'] ?? 'special');

            $entityManager->persist($message);
            $entityManager->flush();

            return $this->redirectToRoute('post_edit', ['id' => $message->getId()]);
        }

        return $this->render('chat_post/index.html.twig', [
            'message_id' => $id,
            'message_created_at' => $created_at,
            'form' => $form,
//            'messages' => $messages,
        ]);
    }
}
