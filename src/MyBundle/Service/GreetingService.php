<?php

namespace App\MyBundle\Service;

class GreetingService
{
//    private string $greetingPrefix;
//
//    public function __construct(string $greetingPrefix)
//    {
//        $this->greetingPrefix = $greetingPrefix;
//    }

    public function greet(string $name): string
    {
        return print($name);
    }
}