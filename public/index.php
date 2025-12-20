function IndexController() {
    // ... existing code ...

    // Metrics: start timing and registry
    require_once __DIR__ . '/../app/metrics/bootstrap.php';
    $metrics_start_ns = hrtime(true);

    // ... existing code generating page/response ...

    $status_code = http_response_code();

    // Metrics: record
    $duration_seconds = (hrtime(true) - $metrics_start_ns) / 1e9;
    metrics_observe_request('/index.php', $_SERVER['REQUEST_METHOD'] ?? 'GET', $status_code, $duration_seconds);

    // ... existing code ...
}