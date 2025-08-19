<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Form\Event\PostSetDataEvent;

final class FormListener
{
    #[AsEventListener(event: 'form.post_set_data')]
    public function onFormPostSetData(PostSetDataEvent $event): void
    {
        // ...
    }
}
