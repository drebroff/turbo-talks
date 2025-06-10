<?php

// @TODO DO NOT WORK THOUGH

namespace App\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestListener
{
    public function __construct(
        private LoggerInterface $logger
    ) {
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $response = $event->getResponse();

        if ($event->isMainRequest()) {
            $a = 123;
            $this->logger->info('Sending response', [
                'status_code' => $response->getStatusCode(),
            ]);

        }

    }
}