<?php
// src/Controller/ChatController.php
namespace App\Controller\Controller;

use App\Entity\Message;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ChatController extends AbstractController
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    #[Route('/',
        name: 'chat',
        requirements: [
            '_locale' => 'en|fr',
            '_format' => 'html|xml',
            '_fragment' => '123' // basically useless, but still in documentation, according ai - is likely a leftover, copy-paste error, or not needed
        ],
//        condition: "request.headers.get('User-Agent') matches '%app.allowed_browsers%'",
        locale: 'en',
        format: 'html')]
    public function index(EntityManagerInterface $entityManager, Request $request, HubInterface $hub, Environment $twig): Response
    {
        $this->addFlash('success', 'Your message was sent!');
        $template = $twig->load('user_page/user_page.html.twig');
        $a = $template->render(['name' => 'test']); // method returns the rendered template as a string
        $messages = $entityManager->getRepository(Message::class)->findBy([], ['createdAt' => 'DESC'], 10);
        $form = $this->createFormBuilder()
//            ->setAction($this->generateUrl('messages'))
            ->add('content', TextType::class, ['attr' => ['autocomplete' => 'off']])
            ->add('send', SubmitType::class)
            ->getForm();
//        $form2 = $this->createForm(ChatForm::class);


        $emptyForm = clone $form; // Used to display an empty form after a POST request
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $message = new Message();
            $message->setContent($data['content'] ?? 'special');

            $entityManager->persist($message);
            $entityManager->flush();
            // 🔥 The magic happens here! 🔥
            // The HTML update is pushed to the client using Mercure
            $hub->publish(new Update(
                'chat',
                $this->renderView('chat/message.stream.html.twig', ['message' => $data['content']])
            ));

            // Force an empty form to be rendered below
            // It will replace the content of the Turbo Frame after a post
            $form = $emptyForm;
        }
        $response  = $this->render('chat/index.html.twig', [
            'messages' => $messages,
            'form' => $form,
//            'form2' => $form2

        ]);
//        $response->setPublic();
//        $response->setMaxAge(0);
        return $response ;
    }

    #[Route('/messages', name: 'messages', methods: ['POST'])]
    public function create(
        Request $request,
        EntityManagerInterface $entityManager,
        HubInterface $hub
    ): Response {
        $content = $request->request->get('content');
        $formData = $request->request->all();
        $message = new Message();
        $message->setContent($formData['form']['content'] ?? 'special');

        $entityManager->persist($message);
        $entityManager->flush();

        // Create the update
        $update = new Update(
            'chat',
            $this->renderView('chat/_message.html.twig', ['message' => $message])
        );

        // Publish the update
        $hub->publish($update);

        if ($request->headers->get('Turbo-Frame')) {
            return $this->redirectToRoute('chat');
        }

        return $this->render('chat/_message.html.twig', [
            'message' => $message,
        ]);
    }
}