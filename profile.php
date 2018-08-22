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
	 //create a folder MyUploadImages for storing images
	 $upload_directory = "MyUploadImages/";
	 
	 echo $TargetPath=time()."id.".pathinfo($UploadedFileName, PATHINFO_EXTENSION);
	
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
 echo "Error Email Exists" ;
		}/*ok*/
	 }/*end if mysqli_stmt*/
	 
if($db->errno){
	$_SESSION['studenterror'] = "EMAIL EXISTS ALREADY!";		
	//header("location:error.php");
	die(); 
	}
elseif($db->errno){
	$_SESSION['studenterror'] = "EMAIL EXISTS ALREADY!";		
	//header("location:error.php");
	die(); 
	}
else{
		$sql_id = "SELECT id FROM student WHERE email='$email' LIMIT 1" ;
		$result = $db->query($sql_id);
		$row = $result->fetch_assoc();
		$_SESSION['enroll_id'] = $row['id'];
		$db->close();
		//header("location:enrollmentid.php");
		} //ok end
	}// end else for insertion
}
?>