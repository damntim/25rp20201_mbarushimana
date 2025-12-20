<?php
use Prometheus\CollectorRegistry;
use Prometheus\Storage\APC;
use Prometheus\Storage\InMemory;

function metrics_registry(): CollectorRegistry {
    static $registry = null;
    if ($registry === null) {
        // Prefer APCu if available, otherwise fallback to in-memory
        $adapter = extension_loaded('apcu') ? new APC() : new InMemory();
        $registry = new CollectorRegistry($adapter);
        // Register metrics once (safe to call multiple times)
        $registry->getOrRegisterCounter(
            'patient_app',
            'requests_total',
            'Total HTTP requests',
            ['endpoint','method','status_code']
        );
        $registry->getOrRegisterHistogram(
            'patient_app',
            'request_duration_seconds',
            'Duration of HTTP requests',
            ['endpoint','method'],
            [0.005,0.01,0.025,0.05,0.1,0.25,0.5,1.0,2.5,5.0]
        );
    }
    return $registry;
}

function metrics_observe_request(string $endpoint, string $method, int $status_code, float $duration_seconds): void {
    $registry = metrics_registry();
    $registry->getCounter('patient_app', 'requests_total')
        ->inc([$endpoint, $method, (string)$status_code]);
    $registry->getHistogram('patient_app', 'request_duration_seconds')
        ->observe($duration_seconds, [$endpoint, $method]);
}