<?php
/**
 * Test helpers — deleteImage().
 * Run: php tests/test_helpers.php
 */

require_once __DIR__ . '/../includes/helpers.php';

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

// 1. deleteImage() does not throw on non-existent file
$threw = false;
try {
    deleteImage('/tmp/nonexistent_railcon_file_' . time() . '.jpg');
} catch (Throwable $e) {
    $threw = true;
}
assert_true(!$threw, 'deleteImage() does not throw on non-existent path');

// 2. deleteImage() removes an existing file
$tmp = tempnam(sys_get_temp_dir(), 'railcon_test_');
assert_true(file_exists($tmp), 'Temp file created');
deleteImage($tmp);
assert_true(!file_exists($tmp), 'deleteImage() removes existing file');

echo "\n$passed passed, $failed failed.\n";
exit($failed > 0 ? 1 : 0);
