<?php
/**
 * Test ADMIN_CONTROL_ID constant.
 * Run: php tests/test_admin_controls_constant.php
 */

require_once __DIR__ . '/../constants/admin_controls.php';

$passed = 0;
$failed = 0;

function assert_true(bool $cond, string $label): void {
    global $passed, $failed;
    if ($cond) {
        echo "PASS: $label\n";
        $passed++;
    } else {
        echo "FAIL: $label\n";
        $failed++;
    }
}

assert_true(defined('ADMIN_CONTROL_ID'), 'ADMIN_CONTROL_ID is defined');
assert_true(ADMIN_CONTROL_ID === 115617, 'ADMIN_CONTROL_ID equals 115617');
assert_true(is_int(ADMIN_CONTROL_ID), 'ADMIN_CONTROL_ID is an integer');

echo "\n$passed passed, $failed failed.\n";
exit($failed > 0 ? 1 : 0);
