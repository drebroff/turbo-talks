<?php
// src/DataCollector/CustomDataCollector.php

namespace App\DataCollector;

use Symfony\Bundle\FrameworkBundle\DataCollector\AbstractDataCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\VarDumper\Cloner\Data;
use Throwable;

class CustomDataCollector extends AbstractDataCollector
{
    private array $collectedData = [];

    public function collect(Request $request, Response $response, ?Throwable $exception = null): void
    {
        $this->data = [
            'request_method' => $request->getMethod(),
            'request_uri' => $request->getRequestUri(),
            'response_status' => $response->getStatusCode(),
            'custom_metrics' => $this->collectedData,
            'memory_usage' => memory_get_usage(true),
            'memory_peak' => memory_get_peak_usage(true),
            'time' => microtime(true),
        ];
    }

    public function reset(): void
    {
        $this->data = [];
        $this->collectedData = [];
    }

    public function getName(): string
    {
        return 'app.custom_collector';
    }

    // Custom methods to add data during request lifecycle
    public function addMetric(string $name, mixed $value): void
    {
        $this->collectedData[$name] = $value;
    }

    public function incrementCounter(string $name): void
    {
        if (!isset($this->collectedData[$name])) {
            $this->collectedData[$name] = 0;
        }
        $this->collectedData[$name]++;
    }

    // Getter methods for the template
    public function getRequestMethod(): string
    {
        return $this->data['request_method'] ?? '';
    }

    public function getRequestUri(): string
    {
        return $this->data['request_uri'] ?? '';
    }

    public function getResponseStatus(): int
    {
        return $this->data['response_status'] ?? 0;
    }

    public function getCustomMetrics(): array
    {
        return $this->data['custom_metrics'] ?? [];
    }

    public function getMemoryUsage(): int
    {
        return $this->data['memory_usage'] ?? 0;
    }

    public function getMemoryPeak(): int
    {
        return $this->data['memory_peak'] ?? 0;
    }

    public function getCollectionTime(): float
    {
        return $this->data['time'] ?? 0.0;
    }

    public static function getTemplate(): ?string
    {
        return 'data_collector/custom.html.twig';
    }
}