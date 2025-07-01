<?php

namespace App\Controller\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class OrangeApiController extends AbstractController
{

        public function __construct(
            private ParameterBagInterface $parameterBag
        )
        {

//            parent::__construct();
        }
    // any method or function returning a PHP Generator
    function loadArticles(): \Generator {
        yield ['title' => 'Article 1'];
        yield ['title' => 'Article 2'];
        yield ['title' => 'Article 3'];
    }

    #[Route('/orange/api', name: 'app_orange_api')]
    public function index(): Response
    {
//        $response = new StreamedJsonResponse(
//            // JSON structure with generators in which will be streamed as a list
//            [
//                '_embedded' => [
//                    'articles' => $this->loadArticles(),
//                ],
//            ],
//        )
//;
//        $response = new StreamedResponse();
//        $response->setCallback(function (): void {
//            var_dump('Hello World');
//            flush();
//            sleep(2);
//            var_dump('Hello World');
//            flush();
//        });

//        $response = new RedirectResponse('http://google.com/');

//        $projectDir = $this->parameterBag->get('kernel.project_dir');
//        $file = $projectDir . '/README.md';
//        $response = new BinaryFileResponse($file);


//        $response = new Response();
//        $response->setContent(json_encode([
//            'data' => 123,
//        ]));
//        $response->headers->set('Content-Type', 'application/json');

//        $response = new JsonResponse(); $response->setData(array('data' => 123));

//        $data = json_encode(array('data' => 123));$response = JsonResponse::fromJsonString($data);

        $response = new JsonResponse(array('data' => 123));

        return $response;
    }

}
