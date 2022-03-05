<?php
echo 'Current PHP version: ' . phpversion();
if (isset($_POST['student_editrecord'])) {
    include ('database_connection.php');
    $db = OpenDatabaseConnection();
    mysqli_report(MYSQLI_REPORT_ALL);
    $idd = $_POST['id'];
    $fullname = $_POST['name'];
    $gender = $_POST['gender'];
    $semester = $_POST['semester'];
    $email = trim($_POST['email'], " \t\n\r");
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $passno = $_POST['passno'];
    $pass_end = NULL;
    if(!empty($_POST['pass_end'])){
        $pass_end = $_POST['pass_end'];
    }
    $voucher = $_POST['voucher'];
    $season = $_POST['season'];
    $classof = $_POST['classof'];
    $duration = $_POST['duration'];
    $branch = $_POST['branch'];
    $year = $_POST['year'];
    $DOB = $_POST['dob'];
    
    $edit = 0;
    extract($_POST);
    $UploadedFileName = $_FILES['UploadImage']['name']; /* error = 4 means image is not changed */ /* size = 0 means image is not uploaded */
    if (! ($_FILES['UploadImage']['error'] == 4 || $_FILES['UploadImage']['size'] == 0)) {
        $image_info = getimagesize($_FILES["UploadImage"]["tmp_name"]);
        if (($_FILES["UploadImage"]["size"] > 1000000)) {
            $_SESSION['studenterror'] = "MAX 1.0MB image allowed!";
            header("location:error.php");
            die();
        } elseif (! exif_read_data($_FILES['UploadImage']['tmp_name'])) {
            $_SESSION['studenterror'] = "Only JPEG/JPG Allowed";
            header("location:error.php");
            die();
        }
        /* create a folder MyUploadImages for storing images */
        $upload_directory = "MyUploadImages/";
        $TargetPath=time()."id.".pathinfo($UploadedFileName, PATHINFO_EXTENSION);
        $q = mysqli_prepare($db,"UPDATE student SET fullname=?, gender=?, semester=?, email=?, DOB=?, contact=?, address=?, pincode=?, source=?, destination=?, passno=?, pass_end=?, voucher=?, season=?, classof=?, duration=?, branch=?, year=?, edit=?, img_loc=? WHERE id= ?") OR die($q->error);
        mysqli_stmt_bind_param($q,"sisssisissssssssssisi",$fullname,$gender,$semester,$email,$DOB,$contact,$address,$pincode,$source,$destination,$passno,$pass_end,$voucher,$season,$classof,$duration,$branch,$year, $edit,$TargetPath, $idd);
        if(mysqli_stmt_execute($q))
        {
            if(move_uploaded_file($_FILES['UploadImage']['tmp_name'], $upload_directory.$TargetPath) )
            {
                if($duration=="Monthly"){
                    $set_del = "UPDATE student SET datetodelete = DATE_ADD(dateofentry , INTERVAL 30 DAY) WHERE email = '$email'" ;
                    echo "<strong> File and Details Uploaded </n> </strong>";
                    $db->query($set_del);
                }
                else if($duration=="Quarterly"){
                    $set_del = "UPDATE student SET datetodelete = DATE_ADD(dateofentry , INTERVAL 90 DAY) WHERE email = '$email'" ;
                    echo "<strong> File and Details Uploaded </n> </strong>"; $db->query($set_del);
                }
            }
            else{
                $del_q = "DELETE FROM student WHERE email='$email' LIMIT 1";
                mysqli_stmt_execute($del_q);
                echo "Error Email Exists" ;
            }
        }
    }
    else{
        /*if image uploaded successfully.*/
        $q = $db->prepare("UPDATE student SET fullname=?, gender=?, semester=?, email=?, DOB=?, contact=?, address=?, pincode=?, source=?, destination=?, passno=?, pass_end=?, voucher=?, season=?, classof=?, duration=?, branch=?, year=?, edit=?  WHERE id= ?") or die("Query preparation failed");
        $q->bind_param("sisssisissssssssssii", $fullname, $gender, $semester, $email, $DOB, $contact, $address, $pincode, $source, $destination, $passno, $pass_end, $voucher, $season, $classof, $duration, $branch, $year, $edit, $idd);
        if ($q->execute()) {
            echo "<script> alert('Record Edited Successfully'); </script>";
            header("Refresh:1; url=index.php");
        }
    } /*else without image*/
}
?>