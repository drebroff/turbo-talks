<?php


// A Trait is like a "partial class." You cannot instantiate it on its own,
// but you can "copy-paste" its methods into other classes at compile time.
// Вобщем методы трайта можно запускать из класса не создавая трайт как обьект.

trait Loggable {
    public const LOG_LEVEL = 'debug'; // PHP 8.2 Traits can now define constants.
    public function share($platform): string
    {
        return "Item shared on $platform";
    }
}
