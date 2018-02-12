<?php

if(isset($_POST['submit']))
{
	session_start();
	$db = new mysqli("localhost","root","","railcon");
	if($db->connect_errno)
	{	die("Database Connection failed"); }

	$fullname= $_POST['name'];
	$roll    = $_POST['roll'];
	$email   = $_POST['email'];
	$contact = $_POST['contact']; 
	$aadhar  = $_POST['aadhar'];
	$address = $_POST['address'];
	$pincode = $_POST['pincode'];
	$source  = $_POST['source'];
	$destination = $_POST['destination'];
	$passno  = $_POST['passno'];
	$classof = $_POST['classof'];
	$duration = $_POST['duration'];
	$branch  =  $_POST['branch'];
	$year    = $_POST['year'];
 	
	extract($_POST);
	$UploadedFileName=$_FILES['UploadImage']['name'];
	$image_info = getimagesize($_FILES["UploadImage"]["tmp_name"]);
	$image_width = $image_info[0];
	$image_height = $image_info[1];
	
	echo "$image_height"."$image_width";
	
	if($UploadedFileName==''){
		echo "<alert> File Name cannot be empty</alert>";
		header("Refresh:1,url=student.html");
		die();
	}
	elseif(($_FILES["UploadImage"]["size"] > 1000000)){
		echo "<script>alert('File size greater than 1MB')</script>";
		header("Refresh:1, url=student.html");
		die();
	}
	elseif( $image_height<500 || $image_width<300 ){
		echo "<script>alert('Minimum Image Resolution widthxheight : 300x500')</script>";
		header("Refresh:0.5, url=student.html");
		die();
	}
	else
	{
	$upload_directory = "MyUploadImages/"; //This is the folder which you created just now
	$TargetPath=time().$UploadedFileName;
	
	$empty = 0;
	$q = mysqli_prepare($db,"INSERT INTO student(id,fullname,roll,email,contact,aadhar,address,pincode,
	source,destination,passno,classof,duration,branch,year,img_loc) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)") OR die($q->error);
	mysqli_stmt_bind_param($q,"isisiisissssssss",$empty,$fullname,$roll,$email,$contact,$aadhar,$address,$pincode,$source,$destination,$passno,$classof,$duration,$branch,$year,$TargetPath);
	if(mysqli_stmt_execute($q)){
		echo "\nInserted into Table\n";
		if(move_uploaded_file($_FILES['UploadImage']['tmp_name'], $upload_directory.$TargetPath) ){
			echo "<strong>\nFile Uploaded\n</n> </strong>";
		}
		else{
			$del_q = "DELETE FROM student WHERE email='$email' LIMIT 1";
			mysqli_stmt_execute($del_q);
		}
	}//execute stmt
	
	if($db->errno){
		//echo "$db->errno";
		die("\nEmail ID already Exists");
    }
	else{
		echo "No errors";
		header("Refresh:2; url=student.html");
		}
	$db->close();
	}
}
?>