#!/usr/bin/env php
<?php
/**
 * Run all tests in the tests/ directory.
 * Usage: php tests/run_all.php
 */

$dir   = __DIR__;
$tests = glob($dir . '/test_*.php');
$total_passed = 0;
$total_failed = 0;

foreach ($tests as $test) {
    $name = basename($test);
    echo "\n=== $name ===\n";
    $output = [];
    $code   = 0;
    exec('php ' . escapeshellarg($test) . ' 2>&1', $output, $code);
    foreach ($output as $line) {
        echo "  $line\n";
    }
    if ($code === 0) {
        $total_passed++;
    } else {
        $total_failed++;
    }
}

echo "\n" . str_repeat('=', 40) . "\n";
echo "Tests: " . count($tests) . " files | $total_passed passed | $total_failed failed\n";
exit($total_failed > 0 ? 1 : 0);
