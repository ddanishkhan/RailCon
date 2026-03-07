<?php
require_once __DIR__ . '/database_connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['email'])) {
    echo json_encode(['status' => 'new']);
    exit;
}

$email = trim($_POST['email']);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'new']);
    exit;
}

$stmt = $db->prepare(
    "SELECT id, fullname, verified, source, destination, classof, duration,
     dateofentry, Remark, img_loc, datetodelete
     FROM student WHERE email = ? LIMIT 1"
);
$stmt->bind_param('s', $email);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$row) {
    echo json_encode(['status' => 'new']);
    exit;
}

echo json_encode([
    'status'      => 'exists',
    'id'          => (int) $row['id'],
    'email'       => $email,
    'name'        => $row['fullname'],
    'verified'    => (int) $row['verified'],
    'source'      => $row['source'],
    'destination' => $row['destination'],
    'classof'     => $row['classof'],
    'duration'    => $row['duration'],
    'dateofentry' => $row['dateofentry'],
    'remark'      => $row['Remark'],
    'img_loc'     => $row['img_loc'],
    'expires_on'  => $row['datetodelete'],
]);
