<?php
// src/Service/ExampleService.php

namespace App\Service;

use App\DataCollector\CustomDataCollector;

class ExampleService
{
    public function __construct(
        private CustomDataCollector $dataCollector
    ) {}

    public function processData(array $data): array
    {
        $this->dataCollector->addMetric('input_size', count($data));
        $this->dataCollector->incrementCounter('service_calls');

        // Process data...
        $processed = array_map('strtoupper', $data);

        $this->dataCollector->addMetric('output_size', count($processed));

        return $processed;
    }
}