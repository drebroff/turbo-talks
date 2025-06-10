<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity]
#[Broadcast] // 🔥 The magic happens here
class Book
{
    #[ORM\Column, ORM\Id, ORM\GeneratedValue(strategy: "AUTO")]
    public ?int $id = null;

    #[ORM\Column]
    public string $title = '';
}