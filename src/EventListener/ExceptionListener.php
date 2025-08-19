<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final class ExceptionListener
{
    /*
     *  listener that handles security exceptions and when appropriate, helps the user to authenticate
     */
    #[AsEventListener]
    public function onExceptionEvent(ExceptionEvent $event): void
    {
        // ...
    }
}
