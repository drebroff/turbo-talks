<?php
// src/Controller/ExampleController.php

namespace App\Controller;

use App\DataCollector\CustomDataCollector;
use App\MyEnum\TrafficLight;
use Fiber;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;

class ExampleController extends AbstractController
{
    #[Route('/example', name: 'app_example')] // PHP 8.0 Attributes. Replace docblock annotations with structured metadata.

    public function index(LoggerInterface $logger, Request $request,CustomDataCollector $dataCollector): Response
    {
        // Add custom metrics
        $dataCollector->addMetric('controller_name', 'ExampleController::index');
        $dataCollector->addMetric('user_agent', $request->headers->get('User-Agent', 'unknown'));
        $dataCollector->incrementCounter('page_views');

        // Simulate some work
        $startTime = microtime(true);
        usleep(100000); // 100ms delay
        $endTime = microtime(true);

        $dataCollector->addMetric('processing_time', ($endTime - $startTime) * 1000 . ' ms');

        // PHP 8.1 Fibers (Lightweight Threads) ✅ Foundation for async libraries (e.g., ReactPHP, Swoole).
        $fiber = new Fiber(function() use ($logger): void {
            $logger->info('Fiber Suspended ' . date('Y-m-d H:i:s'));
            Fiber::suspend();
            $logger->info('Fiber Resumed ' . date('Y-m-d H:i:s'));
        });
        $fiber->start();
        $logger->info('in main ' . date('Y-m-d H:i:s'));
        $fiber->resume();

        return $this->render('example/index.html.twig', [
            'foo' => $this->foo(10),
            'user' => $this->createUser(name: "Alice", age: 25, code: 300),
            'urlDetector' => $this->urlDetector(),
           'trafficSignal' => TrafficLight::Red->getAction(), // PHP 8.1 Backed Enums

        ]);
    }

    /**
     *  PHP 8.0 Allow declaring multiple types for parameters, return values, and properties.
     *
     * @param int|string $value
     * @return int|float
     */
    protected function foo(int|string $value): int|float {

        $adder = strlen(...); // PHP 8.1 Equivalent to fn($str) => strlen($str)
        $adder("hello");

        return is_int($adder) ? $value * 2 : $value / 2;
    }

    protected function urlDetector($url = "https://www.example.com/blog/article-1"): string|null {
        // PHP 8.0 throw can now be used in expressions (e.g., ternary, arrow functions).
        $value = $url ?? throw new InvalidArgumentException("Input required");

        // PHP 8.0 String interpolation
        if (str_contains($url, 'blog')) {
            $blog_message = "This is a blog post.";
        }
        if (str_starts_with($url, 'https')) {
            $connection_message = "The connection is secure.";
        }
        if (str_ends_with($url, 'article-1')) {
            $article_message = "Page in an article.";
        } else {
            $article_message = "Unsupported file format.";
        }
        return $blog_message . '</br>' . $connection_message . '</br>' . $article_message;
    }
    protected function createUser(string $name, int $age, int $code): string
    {
        $user = $this->getUser();
        $country = $user?->getAddress()?->getCountry(); // PHP 8.0 Avoid null checks when calling methods/properties on possibly null objects.

        // PHP 8.0 Match expressions
        $status = match($code) {
            200, 300 => 'success',
            400 => 'bad request',
            500 => 'server error',
            default => 'unknown',
        };

        // PHP 8.1 array_is_list() new function to check if an array is a "list"
        array_is_list([1, 2, 3]);        // true
        array_is_list([0 => 'a', 2 => 'b']); // false (gap)
        array_is_list(['x' => 1]);



        return $name . ' ' . $status;
    }

}