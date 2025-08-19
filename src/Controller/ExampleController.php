<?php
// src/Controller/ExampleController.php

namespace App\Controller;

use App\DataCollector\CustomDataCollector;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ExampleController extends AbstractController
{
    #[Route('/example', name: 'app_example')]
    public function index(CustomDataCollector $dataCollector): Response
    {
        // Add custom metrics
        $dataCollector->addMetric('controller_name', 'ExampleController::index');
        $dataCollector->addMetric('user_agent', $this->getRequest()->headers->get('User-Agent'));
        $dataCollector->incrementCounter('page_views');

        // Simulate some work
        $startTime = microtime(true);
        usleep(100000); // 100ms delay
        $endTime = microtime(true);

        $dataCollector->addMetric('processing_time', ($endTime - $startTime) * 1000 . ' ms');

        // @TODO Write a template
        return $this->render('example/index.html.twig');
    }
}