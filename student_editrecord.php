<?php
session_start();
require_once __DIR__ . '/database_connection.php';
require_once __DIR__ . '/includes/csrf.php';

if (!isset($_POST['student_editrecord'])) {
    header("Location: index.php");
    exit;
}

validate_csrf_token($_POST['csrf_token'] ?? '');

mysqli_report(MYSQLI_REPORT_ALL);
$idd         = (int) $_POST['id'];
$fullname    = $_POST['name'];
$gender      = $_POST['gender'];
$semester    = $_POST['semester'];
$email       = trim($_POST['email']);
$contact     = $_POST['contact'];
$address     = $_POST['address'];
$pincode     = $_POST['pincode'];
$source      = $_POST['source'];
$destination = $_POST['destination'];
$passno      = $_POST['passno'];
$voucher     = $_POST['voucher'];
$season      = $_POST['season'];
$classof     = $_POST['classof'];
$duration    = $_POST['duration'];
$branch      = $_POST['branch'];
$year        = $_POST['year'];
$DOB         = $_POST['dob'];
$passEnd     = $_POST['pass_end'];
$edit        = 0;

$UploadedFileName = $_FILES['UploadImage']['name'];
if (!($_FILES['UploadImage']['error'] == 4 || $_FILES['UploadImage']['size'] == 0)) {
    if ($_FILES['UploadImage']['size'] > 1000000) {
        $_SESSION['studenterror'] = "MAX 1.0MB image allowed!";
        header("Location: error.php");
        exit;
    }
    if (!exif_read_data($_FILES['UploadImage']['tmp_name'])) {
        $_SESSION['studenterror'] = "Only JPEG/JPG Allowed";
        header("Location: error.php");
        exit;
    }
    $upload_directory = "MyUploadImages/";
    $TargetPath = time() . "id." . pathinfo($UploadedFileName, PATHINFO_EXTENSION);
    $q = $db->prepare("UPDATE student SET fullname=?, gender=?, semester=?, email=?, DOB=?, contact=?, address=?, pincode=?, source=?, destination=?, passno=?, pass_end=?, voucher=?, season=?, classof=?, duration=?, branch=?, year=?, edit=?, img_loc=? WHERE id=?");
    $q->bind_param("sisssisissssssssssisi", $fullname, $gender, $semester, $email, $DOB, $contact, $address, $pincode, $source, $destination, $passno, $passEnd, $voucher, $season, $classof, $duration, $branch, $year, $edit, $TargetPath, $idd);
    if ($q->execute()) {
        if (move_uploaded_file($_FILES['UploadImage']['tmp_name'], $upload_directory . $TargetPath)) {
            $interval = ($duration === 'Monthly') ? 28 : 90;
            $stmt_del = $db->prepare("UPDATE student SET datetodelete = DATE_ADD(dateofentry, INTERVAL ? DAY) WHERE id = ?");
            $stmt_del->bind_param("ii", $interval, $idd);
            $stmt_del->execute();
            $stmt_del->close();
        } else {
            $stmt_rb = $db->prepare("DELETE FROM student WHERE id = ? LIMIT 1");
            $stmt_rb->bind_param("i", $idd);
            $stmt_rb->execute();
            $stmt_rb->close();
            $_SESSION['studenterror'] = "Image upload failed.";
            header("Location: error.php");
            exit;
        }
    }
    $q->close();
} else {
    $q = $db->prepare("UPDATE student SET fullname=?, gender=?, semester=?, email=?, DOB=?, contact=?, address=?, pincode=?, source=?, destination=?, passno=?, pass_end=?, voucher=?, season=?, classof=?, duration=?, branch=?, year=?, edit=? WHERE id=?");
    $q->bind_param("sisssisissssssssssii", $fullname, $gender, $semester, $email, $DOB, $contact, $address, $pincode, $source, $destination, $passno, $passEnd, $voucher, $season, $classof, $duration, $branch, $year, $edit, $idd);
    if ($q->execute()) {
        $interval = ($duration === 'Monthly') ? 28 : 90;
        $stmt_del = $db->prepare("UPDATE student SET datetodelete = DATE_ADD(dateofentry, INTERVAL ? DAY) WHERE id = ?");
        $stmt_del->bind_param("ii", $interval, $idd);
        $stmt_del->execute();
        $stmt_del->close();
    }
    $q->close();
}

header("Location: studentsearch.php");
exit;
?>
