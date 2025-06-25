<?php

namespace App\MessageHandler;

use App\Message\SendDummyMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class SendDummyMessageHandler
{
    public function __invoke(SendDummyMessage $message): void
    {
        $a = 123;
        // do something with your message
        echo 'Hello, ' . $message->name . '!';

    }
}
