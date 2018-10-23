<?php
if(!isset($_POST['submit'])){
  header('location:index.php');
}
else
{
	session_start();
 	include('database_connection.php');
	
	$sql_display = "SELECT MAX(id) AS id FROM student";
	$result = $db->query($sql_display);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$student_id = $row['id'];
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
	/*   Query to check email exists if exists then check if it is one month/3 month old based on date of entry   */
	$select = mysqli_query($db, "SELECT `email` FROM `student` WHERE `email` = '".$_POST['email']."'") or exit(mysqli_error($db));
	if(mysqli_num_rows($select)) {	
		/**********     ACTION for email exists already     **************/
		echo "Email Exists ALREADY<br>";
		
		/*****TRANSACTION FOR MONTHLY PASSES **/
		mysqli_query ($db, 'BEGIN TRANSACTION;');
		echo "Begin TRANSACTION<br>";
		mysqli_query ($db, "INSERT INTO oldstudent(oldid,fullname,gender,semester,email,DOB,contact,aadhar,address,pincode,source,destination,passno,pass_end,voucher,season,classof,duration,branch,year,verified,dateofentry,datetodelete,Remark) SELECT id,fullname,gender,semester,email,DOB,contact,aadhar,address,pincode,source,  destination,passno,pass_end,voucher,season,classof,duration,branch,year,verified,dateofentry,datetodelete,Remark FROM student WHERE YEAR(dateofentry) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(dateofentry) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND duration='Monthly' AND verified=1;" ) ;
		if ($errMsg = mysqli_error ($db))
		{
			mysqli_query ($db,'ROLLBACK;');
		echo "TRANSACTION 1 (Monthly Forms) Error<br>";
			die ($errMsg);
		}
		mysqli_query ($db, "DELETE FROM student
	WHERE YEAR(dateofentry) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(dateofentry) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND duration='Monthly'  AND verified=1;");
		if ($errMsg = mysqli_error ($db))
		{
			mysqli_query ($db,'ROLLBACK;');
		echo "TRANSACTION 2 Error<br>";
			die ($errMsg);
		}
		mysqli_query ($db, 'COMMIT');
		/*****TRANSACTION FOR MONTHLY PASSES **/
		
		/*****TRANSACTION FOR Quarterly PASSES **/
		mysqli_query ($db, 'BEGIN TRANSACTION;');
		echo "Begin TRANSACTION<br>";
		mysqli_query ($db, "INSERT INTO oldstudent(oldid,fullname,gender,semester,email,DOB,contact,aadhar,address,pincode,source,destination,passno,pass_end,voucher,season,classof,duration,branch,year,verified,dateofentry,datetodelete,Remark) SELECT id,fullname,gender,semester,email,DOB,contact,aadhar,address,pincode,source,  destination,passno,pass_end,voucher,season,classof,duration,branch,year,verified,dateofentry,datetodelete,Remark FROM student WHERE YEAR(dateofentry) = YEAR(CURRENT_DATE - INTERVAL 4 MONTH) AND MONTH(dateofentry) = MONTH(CURRENT_DATE - INTERVAL 4 MONTH) AND duration='Quarterly'  AND verified=1 ;");
		if ($errMsg = mysqli_error ($db))
		{
			mysqli_query ($db,'ROLLBACK;');
		echo "TRANSACTION 1 Error<br>";
			die ($errMsg);
		}
		mysqli_query ($db, "DELETE FROM student
	WHERE YEAR(dateofentry) = YEAR(CURRENT_DATE - INTERVAL 4 MONTH) AND MONTH(dateofentry) = MONTH(CURRENT_DATE - INTERVAL 4 MONTH) AND duration='Quarterly'  AND verified=1;");
		if ($errMsg = mysqli_error ($db))
		{
			mysqli_query ($db,'ROLLBACK;');
		echo "TRANSACTION 2 Error<br>";
			die ($errMsg);
		}
		mysqli_query ($db, 'COMMIT');
		/*****TRANSACTION FOR Quarterly PASSES **/
	
	}
	 echo "UPLAODING";
	 //create a folder MyUploadImages for storing images
	 $upload_directory = "MyUploadImages/";
	 
	$TargetPath=time()."id.".pathinfo($UploadedFileName, PATHINFO_EXTENSION);
	
	 $empty = 0;
	 $q = mysqli_prepare($db,"INSERT INTO student(id,fullname,gender,semester,email,DOB,contact,aadhar,address,pincode,
	 source,destination,passno,pass_end,voucher,season,classof,duration,branch,year,img_loc,dateofentry) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)") OR die($q->error);
	 mysqli_stmt_bind_param($q,"isiissiisisssssissssss",$empty,$fullname,$gender,$sem,$email,$age,$contact,$aadhar,$address,$pincode,$source,$destination,$passno,$pass_end,$voucher,$season,$classof,$duration,$branch,$year,$TargetPath,$dateofentry);	
	 if(mysqli_stmt_execute($q))
	 {
		/* echo "\nInserted into Table\n"; */
		if(move_uploaded_file($_FILES['UploadImage']['tmp_name'], $upload_directory.$TargetPath) ){
			
			if($duration=="Monthly"){
			  $set_del = "UPDATE student SET datetodelete = DATE_ADD(dateofentry , INTERVAL 30 DAY) WHERE email = '$email'" ;
			  echo "<strong> File and Details Uploaded  </n> </strong>";
			  $db->query($set_del);	}
			elseif($duration=="Quarterly"){
			  $set_del = "UPDATE student SET datetodelete = DATE_ADD(dateofentry , INTERVAL 90 DAY) WHERE email = '$email'" ;
			echo "<strong> File and Details Uploaded  </n> </strong>";
			    $db->query($set_del);		}
				
		}/*ok*/
		else{
			$del_q = "DELETE FROM student WHERE email='$email' LIMIT 1";
			mysqli_stmt_execute($del_q); //execute stmt
		}/*ok*/
 echo "Error Email Exists" ;
	 }/*end if mysqli_stmt*/
	 
if($db->errno){
	$_SESSION['studenterror'] = "EMAIL EXISTS ALREADY! <br> Your previous pass duration is not completed according to the database, please fill form again after pass expiration ";
	header("location:error.php");
	die(); 
	}
else{
		$sql_id = "SELECT id FROM student WHERE email='$email' LIMIT 1" ;
		$result = $db->query($sql_id);
		$row = $result->fetch_assoc();
		$_SESSION['enroll_id'] = $row['id'];
		$db->close();
		header("location:enrollmentid.php");
		} //ok end
	}// end else for insertion
}
?>