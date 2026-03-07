<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/includes/csrf.php';
require_once __DIR__ . '/includes/redirect.php';
require_once __DIR__ . '/database_connection.php';
mysqli_report(MYSQLI_REPORT_ALL);

validate_csrf_token($_POST['csrf_token'] ?? '');

$idd = (int) $_POST['id'];

if (isset($_POST['edit_fullname'])) {
    $fullname = $_POST['fullname'];
    $q = $db->prepare("UPDATE student SET fullname = ? WHERE id= ?") OR die("Query preparation failed");
    $q->bind_param("si", $fullname, $idd);
} elseif (isset($_POST['edit_gender'])) {
    $gender = $_POST['gender'];
    $q = $db->prepare("UPDATE student SET gender = ? WHERE id= ?") OR die("Query preparation failed");
    $q->bind_param("ii", $gender, $idd);
} elseif (isset($_POST['edit_DOB'])) {
    $DOB = $_POST['DOB'];
    $q = $db->prepare("UPDATE student SET DOB = ? WHERE id= ?") OR die("Query preparation failed");
    $q->bind_param("si", $DOB, $idd);
} elseif (isset($_POST['edit_email'])) {
    $email = trim($_POST['email']);
    $q = $db->prepare("UPDATE student SET email = ? WHERE id= ?") OR die("Query preparation failed");
    $q->bind_param("si", $email, $idd);
} elseif (isset($_POST['edit_source'])) {
    $source = $_POST['source'];
    $q = $db->prepare("UPDATE student SET source = ? WHERE id= ?") OR die("Query preparation failed");
    $q->bind_param("si", $source, $idd);
} elseif (isset($_POST['edit_destination'])) {
    $destination = $_POST['destination'];
    $q = $db->prepare("UPDATE student SET destination = ? WHERE id= ?") OR die("Query preparation failed");
    $q->bind_param("si", $destination, $idd);
} elseif (isset($_POST['edit_classof'])) {
    $classof = $_POST['classof'];
    $q = $db->prepare("UPDATE student SET classof = ? WHERE id= ?") OR die("Query preparation failed");
    $q->bind_param("si", $classof, $idd);
} elseif (isset($_POST['edit_duration'])) {
    $duration = $_POST['duration'];
    $q = $db->prepare("UPDATE student SET duration = ? WHERE id= ?") OR die("Query preparation failed");
    $q->bind_param("si", $duration, $idd);
} else {
    redirect_to_panel();
}

$q->execute();
redirect_to_panel();
?>
