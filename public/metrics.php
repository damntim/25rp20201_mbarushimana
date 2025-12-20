<?php
require __DIR__ . '/../app/metrics/bootstrap.php';

use Prometheus\RenderTextFormat;

header('Content-Type: ' . RenderTextFormat::MIME_TYPE);
$registry = metrics_registry();
$renderer = new RenderTextFormat();
echo $renderer->render($registry->getMetricFamilySamples());