<?php
//display all errors.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


function deleteImage($imageLocation){
    echo "Deleting Image $imageLocation <br>";
    if (file_exists($imageLocation)) {
        unlink($imageLocation);
    }
}

function checkIfPassExpiredForExistingEmail($select, $db){
    /**
     * ******** ACTION for email exists already *************
     */
    echo "<br>Email Exists ALREADY - Checking if earlier pass expired.<br>";
    
    /* old image */
    $row = mysqli_fetch_assoc($select);
    echo $delimg = 'MyUploadImages/' . $row['img_loc'];
    $duration = $row['duration'];
    $days = 100;
    if (strcasecmp('Monthly', $duration)){
        $days = 28;
    }
    else if (strcasecmp('Quarterly', $duration)){
        $days = 88;
    }
    
    /**
     * ***TRANSACTION FOR MONTHLY PASSES *
     */
    echo "START TRANSACTION<br>";
    
    mysqli_query($db, 'START TRANSACTION;');
    $query = "INSERT INTO oldstudent(oldid,fullname,gender,semester,email,DOB,contact,aadhar,address,pincode,source,destination,passno,pass_end,voucher,season,classof,duration,branch,year,verified,dateofentry,datetodelete,Remark) SELECT id,fullname,gender,semester,email,DOB,contact,aadhar,address,pincode,source,  destination,passno,pass_end,voucher,season,classof,duration,branch,year,verified,dateofentry,datetodelete,Remark FROM student WHERE dateofentry <= subdate(current_date, $days) AND duration='$duration'; ";
    echo "Query[$query]";
    mysqli_query($db, $query);
    if ($errCode = mysqli_error($db) || mysqli_affected_rows($db) <= 0) {
        mysqli_query($db, 'ROLLBACK;');
        echo "1. Error[$errCode] OR No records could be moved to oldstudent table <br>";
        return false;
    } else {
        echo "1. Details Moved to oldstudent table<br>";
    }
    mysqli_query($db, "DELETE FROM student WHERE dateofentry <= subdate(current_date, $days) AND duration='$duration';");
    if ($errCode = mysqli_error($db) || mysqli_affected_rows($db) <= 0) {
        mysqli_query($db, 'ROLLBACK;');
        echo "2. Error[$errCode] OR No records deleted from existing table. Rollback.<br>";
        return false;
    } else {
        echo "2. OK<br>";
    }
    /* Delete Old Image when moving */
    deleteImage($delimg);
    mysqli_query($db, 'COMMIT');
    
    return true;
}

function profile_error($existingEmail, $email){
    if($existingEmail){
        echo "ERROR Cannot Create a new record. Email Exists.";
        $_SESSION['studenterror'] = "EMAIL EXISTS ALREADY! <br> Your previous pass duration is not completed according to the database, please fill form again after pass expiration OR ask office to delete your record.";
        $_SESSION['studentemail'] = $email;
    }
    else{
        echo "Unknown FATAL Error. Contact Admin";
    }
}

if(!isset($_POST['submit'])){
    header('location:index.php');
}
else
{
    session_start();
    require 'database_connection.php' ;
    $db = OpenDatabaseConnection();
    
    $sql_display = "SELECT MAX(id) AS id FROM student";
    $result = $db->query($sql_display);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $student_id = $row['id'];
        }
    }
    
    $sql_display = "SELECT VERSION()";
    $result = $db->query($sql_display);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row['VERSION()'];
            
        }
    }
    
    
    $sql_display1 = "SELECT end_entry FROM admin_controls WHERE id_control = '115617' LIMIT 1";
    $result1 = $db->query($sql_display1);
    if ($result1->num_rows > 0) {
        while($row = $result1->fetch_assoc()) {
            $admin_end_id = $row['end_entry'];
        }
    }
    
    if($student_id >= $admin_end_id){
        $_SESSION['studenterror'] = "Entries are closed untill further notice. ";
        header("location:error.php");
        die();
    }
    
    $fullname= $_POST['name'];
    $gender = $_POST['gender'];
    $sem    = $_POST['semester'];
    /*SESSION variable for email redirecting to student search if email is already inserted*/
    $_SESSION['studentemail'] = $_POST['email'];
    $email   = $_POST['email'];
    $contact = $_POST['contact'];
    $aadhar  = 123456789;
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $source  = $_POST['source'];
    $destination = $_POST['destination'];
    $passno  = $_POST['passno'];
    $pass_end  = $_POST['pass_end'];
    $voucher  = $_POST['voucher'];
    $season  = $_POST['season'];
    $classof = $_POST['classof'];
    $duration = $_POST['duration'];
    $branch  =  $_POST['branch'];
    $year    = $_POST['year'];
    $age	= $_POST['dob'];
    $dateofentry = date("Y-m-d");
    
    $from = new DateTime($age);
    $to = new DateTime('today');
    $cur_age = $from->diff($to)->y;
    
    extract($_POST);
    $UploadedFileName=$_FILES['UploadImage']['name'];
    $image_info = getimagesize($_FILES["UploadImage"]["tmp_name"]);
    $image_width = $image_info[0];
    $image_height = $image_info[1];
    
    if($cur_age>=25){
        $_SESSION['studenterror'] = "Age limit is 25";
        header("location:error.php");
        die();
    }
    elseif(!exif_read_data($_FILES['UploadImage']['tmp_name']) ){
        $_SESSION['studenterror'] = "Only JPEG/JPG Allowed";
        header("location:error.php");
        die();
    }
    elseif($UploadedFileName==''){
        $_SESSION['studenterror'] = "Image File Name is empty";
        header("location:error.php");
        die();
    }
    elseif(($_FILES["UploadImage"]["size"] > 1000000)){
        $_SESSION['studenterror'] = "MAX 1.0MB image allowed!";
        header("location:error.php");
        die();
    }
    elseif( $image_height<100 || $image_width<100 ){
        $_SESSION['studenterror'] = "Image is TOO SMALL!";
        header("location:error.php");
        die();
    }
    else
    {
        $proceed = true;
        /*   Query to check email exists if exists then check if it is one month/3 month old based on date of entry   */
        $select = mysqli_query($db, "SELECT `email`, `img_loc`, `duration` FROM `student` WHERE `email` = '".$_POST['email']."'") or exit(mysqli_error($db));
        if(mysqli_num_rows($select)) {
            $proceed = checkIfPassExpiredForExistingEmail($select, $db);
        }
        
        if($proceed){
            echo "Executing";
            
            // create a folder MyUploadImages for storing images
            $upload_directory = "MyUploadImages/";
            
            $TargetPath = time() . "id." . pathinfo($UploadedFileName, PATHINFO_EXTENSION);
            
            $empty = 0;
            $q = mysqli_prepare($db, "INSERT INTO student(id,fullname,gender,semester,email,DOB,contact,aadhar,address,pincode,
	 source,destination,passno,pass_end,voucher,season,classof,duration,branch,year,img_loc,dateofentry) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)") or die($q->error);
            mysqli_stmt_bind_param($q, "isiissiisisssssissssss", $empty, $fullname, $gender, $sem, $email, $age, $contact, $aadhar, $address, $pincode, $source, $destination, $passno, $pass_end, $voucher, $season, $classof, $duration, $branch, $year, $TargetPath, $dateofentry);
            if (mysqli_stmt_execute($q)) {
                /* echo "\nInserted into Table\n"; */
                if (move_uploaded_file($_FILES['UploadImage']['tmp_name'], $upload_directory . $TargetPath)) {
                    
                    if ($duration == "Monthly") {
                        $set_del = "UPDATE student SET datetodelete = DATE_ADD(dateofentry , INTERVAL 28 DAY) WHERE email = '$email'";
                        echo "<strong> File and Details Uploaded  </n> </strong>";
                        $db->query($set_del);
                    } elseif ($duration == "Quarterly") {
                        $set_del = "UPDATE student SET datetodelete = DATE_ADD(dateofentry , INTERVAL 87 DAY) WHERE email = '$email'";
                        echo "<strong> File and Details Uploaded  </n> </strong>";
                        $db->query($set_del);
                    }
                } /* ok */
                else {
                    $del_q = "DELETE FROM student WHERE email='$email' LIMIT 1";
                    mysqli_stmt_execute($del_q); // execute stmt
                } /* ok */
            } /* end if mysqli_stmt */
            
            
            if ($db->errno) {
                profile_error(false, $email);
                header("location:studentsearch.php");
                die();
            } else {
                $sql_id = "SELECT id FROM student WHERE email='$email' LIMIT 1";
                $result = $db->query($sql_id);
                $row = $result->fetch_assoc();
                $_SESSION['enroll_id'] = $row['id'];
                $db->close();
                header("location:enrollmentid.php");
            } // ok end
        }
        else{
            //Email Already exists & record was not deleted. Send error
            profile_error(true, $email);
            header("location:studentsearch.php");
        }
    }
}

?>