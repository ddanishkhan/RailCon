<?php
/**
 * Test CSRF helpers.
 * Run: php tests/test_csrf.php
 */

// Bootstrap session + csrf
session_start();
require_once __DIR__ . '/../includes/csrf.php';

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

// 1. generate_csrf_token() returns a non-empty string
$token1 = generate_csrf_token();
assert_true(is_string($token1) && strlen($token1) > 0, 'generate_csrf_token returns non-empty string');

// 2. Calling again returns same token (idempotent)
$token2 = generate_csrf_token();
assert_true($token1 === $token2, 'generate_csrf_token is idempotent');

// 3. csrf_input() returns an HTML input element containing the token
$input = csrf_input();
assert_true(strpos($input, 'type="hidden"') !== false, 'csrf_input contains hidden input');
assert_true(strpos($input, $token1) !== false, 'csrf_input embeds the token');

// 4. validate_csrf_token passes with correct token
$threw = false;
try {
    validate_csrf_token($token1);
} catch (Throwable $e) {
    $threw = true;
}
assert_true(!$threw, 'validate_csrf_token passes with correct token');

// 5. validate_csrf_token dies on wrong token
// Capture die() via output buffering + register_shutdown_function trick:
// We test indirectly — call with wrong token and check process exit code via a subprocess.
$result = shell_exec('php -r \'
    session_start();
    require "' . __DIR__ . '/../includes/csrf.php";
    generate_csrf_token();
    validate_csrf_token("wrong_token");
    echo "SHOULD_NOT_REACH";
\'');
assert_true($result !== 'SHOULD_NOT_REACH', 'validate_csrf_token dies on wrong token');

echo "\n$passed passed, $failed failed.\n";
exit($failed > 0 ? 1 : 0);
