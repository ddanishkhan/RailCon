<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();
error_reporting(E_ERROR | E_PARSE);
include 'logs/LOGGER.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once __DIR__ . '/database_connection.php';

    if (isset($_POST['bulkIssueSubmit'])) {
        logger::log("INFO", "inside bulkIssueIds");

        $raw = $_POST['bulkIssueIds'] ?? '';
        $ids = array_filter(array_map('intval', explode(',', $raw)));

        if (!empty($ids)) {
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $stmt = $db->prepare("UPDATE student SET verified = 1 WHERE id IN ($placeholders)");
            $stmt->bind_param(str_repeat('i', count($ids)), ...$ids);
            $stmt->execute();
            logger::log("INFO", "Bulk updated IDs: $raw");
            $stmt->close();
        } else {
            logger::log("ERROR", "EMPTY IDS: $raw");
        }

        adminRedirect();
    }

    adminRefreshRedirect();

} else {
    adminRedirect();
}

function adminRedirect(): void {
    logger::log("INFO", "Session Logged In [".$_SESSION['loggedin'] . "]|USER=[" .$_SESSION['user'] . "]");
    header("Location: admin.php");
    exit;
}

function adminRefreshRedirect(): void {
    logger::log("INFO", "Session Logged In [".$_SESSION['loggedin'] . "]|USER=[" .$_SESSION['user'] . "]");
    header("Refresh:0.5, url:admin.php");
    exit;
}
?>
