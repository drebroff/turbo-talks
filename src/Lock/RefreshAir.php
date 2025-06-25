<?php

namespace App\Lock;

use Symfony\Component\Lock\Key;

class RefreshAir
{
    public function __construct(
        private object $article,
        private Key $key,
    ) {
    }

    public function getArticle(): object
    {
        return $this->article;
    }

    public function getKey(): Key
    {
        return $this->key;
    }
}