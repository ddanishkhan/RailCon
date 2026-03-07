<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require_once __DIR__ . '/database_connection.php';
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/constants/admin_controls.php';


if (!isset($_POST['submit'])) {
    header('location:index.php');
    die();
}

$result     = $db->query("SELECT MAX(id) AS id FROM student");
$student_id = $result->fetch_assoc()['id'] ?? 0;

$stmt_ctrl    = $db->prepare("SELECT end_entry FROM admin_controls WHERE id_control = ? LIMIT 1");
$ctrl_id      = ADMIN_CONTROL_ID;
$stmt_ctrl->bind_param("i", $ctrl_id);
$stmt_ctrl->execute();
$result1      = $stmt_ctrl->get_result();
$stmt_ctrl->close();
$admin_end_id = ($result1 ? $result1->fetch_assoc()['end_entry'] : 0) ?? 0;

if ($student_id >= $admin_end_id) {
    $_SESSION['studenterror'] = "Entries are closed until further notice.";
    header("location:error.php");
    die();
}

$fullname    = $_POST['name'];
$gender      = $_POST['gender'];
$sem         = $_POST['semester'];
$email       = $_POST['email'];
$_SESSION['studentemail'] = $email;
$contact     = $_POST['contact'];
$aadhar      = 123456789;
$address     = $_POST['address'];
$pincode     = $_POST['pincode'];
$source      = $_POST['source'];
$destination = $_POST['destination'];
$passno      = $_POST['passno'];
$passEnd     = !empty($_POST['pass_end']) ? $_POST['pass_end'] : null;
$voucher     = ($passno === 'NO' || empty($_POST['voucher'])) ? null : $_POST['voucher'];
$season      = ($passno === 'NO' || empty($_POST['season']))  ? null : $_POST['season'];
$classof     = $_POST['classof'];
$duration    = $_POST['duration'];
$branch      = $_POST['branch'];
$year        = $_POST['year'];
$dob         = $_POST['dob'];
$dateofentry = date("Y-m-d");

$from    = new DateTime($dob);
$to      = new DateTime('today');
$cur_age = $from->diff($to)->y;

$UploadedFileName = $_FILES['UploadImage']['name'];
$image_info       = getimagesize($_FILES["UploadImage"]["tmp_name"]);
$image_width      = $image_info[0];
$image_height     = $image_info[1];

if ($cur_age >= 25) {
    $_SESSION['studenterror'] = "Age limit is 25";
    header("location:error.php");
    die();
}
if (!exif_read_data($_FILES['UploadImage']['tmp_name'])) {
    $_SESSION['studenterror'] = "Only JPEG/JPG Allowed";
    header("location:error.php");
    die();
}
if ($UploadedFileName === '') {
    $_SESSION['studenterror'] = "Image File Name is empty";
    header("location:error.php");
    die();
}
if ($_FILES["UploadImage"]["size"] > 1000000) {
    $_SESSION['studenterror'] = "MAX 1.0MB image allowed!";
    header("location:error.php");
    die();
}
if ($image_height < 100 || $image_width < 100) {
    $_SESSION['studenterror'] = "Image is TOO SMALL!";
    header("location:error.php");
    die();
}

$stmt_sel = $db->prepare("SELECT id FROM student WHERE email = ? LIMIT 1");
$stmt_sel->bind_param("s", $email);
$stmt_sel->execute();
$email_exists = $stmt_sel->get_result()->num_rows > 0;
$stmt_sel->close();

if ($email_exists) {
    if (isset($_SESSION['override_email_check'])) {
        unset($_SESSION['override_email_check']);
        forceArchiveEmail($email, $db);
    } else {
        $expired = checkIfPassExpiredForExistingEmail($email, $duration, $db);
        if (!$expired) {
            $_SESSION['studenterror'] = "EMAIL EXISTS ALREADY! <br> Your previous pass duration is not completed according to the database, please fill form again after pass expiration OR ask office to delete your record.";
            $_SESSION['allow_override'] = true;
            header("location:studentsearch.php");
            die();
        }
    }
}

$upload_directory = "MyUploadImages/";
$TargetPath       = time() . "id." . pathinfo($UploadedFileName, PATHINFO_EXTENSION);

if (!move_uploaded_file($_FILES['UploadImage']['tmp_name'], $upload_directory . $TargetPath)) {
    $_SESSION['studenterror'] = "Image upload failed. Please try again.";
    header("location:error.php");
    die();
}

$q = $db->prepare(
    "INSERT INTO student(fullname,gender,semester,email,DOB,contact,aadhar,address,pincode,
     source,destination,passno,pass_end,voucher,season,classof,duration,branch,year,img_loc,dateofentry)
     VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"
);
$q->bind_param(
    "siissiisisssssissssss",
    $fullname, $gender, $sem, $email, $dob, $contact, $aadhar,
    $address, $pincode, $source, $destination, $passno, $passEnd,
    $voucher, $season, $classof, $duration, $branch, $year, $TargetPath, $dateofentry
);
if (!$q->execute()) {
    @unlink($upload_directory . $TargetPath);
    $_SESSION['studenterror'] = "Unknown FATAL Error. Contact Admin";
    header("location:studentsearch.php");
    die();
}

$interval   = ($duration === 'Monthly') ? 28 : 87;
$stmt_date  = $db->prepare("UPDATE student SET datetodelete = DATE_ADD(dateofentry, INTERVAL ? DAY) WHERE email = ?");
$stmt_date->bind_param("is", $interval, $email);
$stmt_date->execute();
$stmt_date->close();

$stmt_id = $db->prepare("SELECT id FROM student WHERE email = ? LIMIT 1");
$stmt_id->bind_param("s", $email);
$stmt_id->execute();
$row = $stmt_id->get_result()->fetch_assoc();
$stmt_id->close();

$_SESSION['enroll_id'] = $row['id'];
$db->close();
header("location:enrollmentid.php");
die();
