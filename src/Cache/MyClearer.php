<?php

namespace App\Cache;

use Symfony\Component\HttpKernel\CacheClearer\CacheClearerInterface;
use Psr\Log\LoggerInterface;


// kernel.cache_clearer
// Purpose: Register your service to be called during the cache clearing process
class MyClearer implements CacheClearerInterface
{


    public function __construct(
        private LoggerInterface $logger, // PHP 8.0 Reduce boilerplate in class constructors.
    )
    {

    }


    public function clear(string $cacheDir): void
    {
        $this->logger->info('cache:clear command was executed on ' . date('Y-m-d H:i:s'));
    }
}