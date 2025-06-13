<?php

namespace App\Cache;

use Symfony\Component\HttpKernel\CacheClearer\CacheClearerInterface;
use Psr\Log\LoggerInterface;


// kernel.cache_clearer
// Purpose: Register your service to be called during the cache clearing process
class MyClearer implements CacheClearerInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    public function clear(string $cacheDir): void
    {
        $this->logger->info('cache:clear command was executed on ' . date('Y-m-d H:i:s'));
    }
}