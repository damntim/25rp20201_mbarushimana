function ApiController() {
    // ... existing code ...

    // Metrics: start timing and registry
    require_once __DIR__ . '/../app/metrics/bootstrap.php';
    $metrics_start_ns = hrtime(true);

    // ... existing code handling request ...
    // Example: after you decide the response status and body:
    $status_code = http_response_code(); // ensure this reflects actual status

    // Metrics: record count and duration
    $duration_seconds = (hrtime(true) - $metrics_start_ns) / 1e9;
    metrics_observe_request('/api.php', $_SERVER['REQUEST_METHOD'] ?? 'GET', $status_code, $duration_seconds);

    // ... existing code ...
}