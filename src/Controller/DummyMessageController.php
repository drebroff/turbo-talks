<?php

namespace App\Controller;

use App\Message\SendDummyMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\HttpClient\Messenger\PingWebhookMessage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Lock\LockFactory;
use Symfony\Component\Lock\Store\SemaphoreStore;
use App\Lock\RefreshAir;
use Symfony\Component\Lock\Key;
final class DummyMessageController extends AbstractController
{
    public MailerInterface $mailer; // Property injection


    #[Route('/dummy/message/{page}', name: 'app_dummy_message', defaults: ['page' => 1, 'title' => 'foobar'])]
    public function index(
        int $page, string $title,

        Request $request // Setter injection
    ): Response
    {
        dump($title);
        $печеньки = $request->cookies; // I worked on this question before

        $store = new SemaphoreStore();
        $factory = new LockFactory($store);
        $m = $request->query->get('bar', 'baz'); // "baz" will be returned by the following code
                                        // when the query string is "?foo=bar" ? "$request->query->get('bar', 'baz');"
        $key = new Key('article.'. '1234567890');
        $lock = $factory->createLockFromKey(
            $key,
            300,  // ttl
            false // Don't forget to set the autoRelease argument to false in the Lock instantiation
                            // to avoid releasing the lock when the destructor is called.
        );
        $lock->acquire(true);
        $article = new class {
            public $foo = 'bar';
            public function sayHello() {
                return "Hello!";
            }
        };

//        echo $obj->foo; // "bar"
//        echo $obj->sayHello(); // "Hello!"

//        $this->bus->dispatch(new RefreshAir ($article, $key));



        $lock = $factory->createLock('dummy-creation');

        if ($lock->acquire()) {
            // The resource "pdf-creation" is locked.
            // You can compute and generate the invoice safely here.

            $lock->release();
        }
        $astAsArray = (new ExpressionLanguage())
            ->parse('1 + 2', [])
            ->getNodes()
            ->toArray() // literally dumps AST
        ;
        return $this->render('dummy_message/index.html.twig', [
            'controller_name' => 'DummyMessageController',
            'astAsArray' => $astAsArray,
//            'apples' =
            'data' => ['first' => 0, 'first-page' => 1],
        ]);
    }

    /**
     * @throws ExceptionInterface
     */
    #[Route(
        '/hello/{name}',
        name: 'app_message_dummy',
//        condition: "context.getMethod() in ['GET', 'HEAD'] and request.headers.get('User-Agent') matches '/firefox/i'",
         condition: "request.headers.get('User-Agent') matches '%app.allowed_browsers%'"

    )]
    public function hello(string $name, MessageBusInterface $bus, Request $request): Response
    {
        // No, because "forward" method in controller and not in Request class, so we cannot use it when calling Request object
//        $this->forward('')
        $bus->dispatch(new SendDummyMessage($name));

        // Message permits to request an url, in symfony messenger
        $bus->dispatch(new PingWebhookMessage('GET', 'https://google.com/'));

        return new Response('Message dispatched!');
    }

}
