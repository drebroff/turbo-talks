<?php

namespace App\Lock;

use Symfony\Component\Lock\Key;
use Serializable;
use Stringable;
use Random\Randomizer;

readonly class RefreshAir // PHP 8.1 readonly class
{
    public function __construct(
        private object $article,
        private Key $key,
        private Randomizer $randomizer,
        public readonly string $name, // PHP 8.1 readonly property

    ) {
    }

    public function process(
        (Key & Serializable) | Stringable $input // PHP 8.2 DNF (Disjunctive Normal Form)
    ): void {
        $randomBytes = $this->randomizer->getBytes(16); // PHP 8.2 Randimizer::getBytes()
        $randomInt = $this->randomizer->getInt(1, 100); // PHP 8.2 Randimizer
        // logic here
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