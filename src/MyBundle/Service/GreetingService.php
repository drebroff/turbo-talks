<?php

namespace App\MyBundle\Service;

use Symfony\Bundle\SecurityBundle\Security;
use App\Entity\User;

class GreetingService
{
//    private string $greetingPrefix;
//
//    public function __construct(string $greetingPrefix)
//    {
//        $this->greetingPrefix = $greetingPrefix;
//    }
    public function __construct(
        private Security $security
    ) {}


    public function greet(string $name): string
    {
        $user = $this->security->getUser(); //How can you get the $user in a Service ?
        return print($user);
    }
}