<?php

if(isset($_POST['submit']))
{
	/*
	
	Query for table creation.
	Create a folder for images called UploadImage
	
	CREATE TABLE `student` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `fullname` varchar(30) NOT NULL,
 `roll` int(10) unsigned NOT NULL,
 `email` varchar(30) NOT NULL,
 `contact` bigint(15) unsigned NOT NULL,
 `aadhar` bigint(15) unsigned NOT NULL,
 `address` varchar(50) NOT NULL,
 `pincode` mediumint(6) unsigned NOT NULL,
 `source` varchar(20) NOT NULL,
 `destination` varchar(20) NOT NULL,
 `passno` varchar(20) NOT NULL,
 `classof` varchar(20) NOT NULL,
 `duration` varchar(20) NOT NULL,
 `branch` varchar(20) NOT NULL,
 `year` varchar(20) NOT NULL,
 `img_loc` varchar(50) NOT NULL,
 `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
 PRIMARY KEY (`id`),
 UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
	
	*/
	
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
	$age	= $_POST['dob'];
	
	$from = new DateTime($age);
	$to = new DateTime('today');
	$cur_age = $from->diff($to)->y; //calculating age Requires PHP >=5.3.0
 	
	extract($_POST);
	$UploadedFileName=$_FILES['UploadImage']['name'];
	$image_info = getimagesize($_FILES["UploadImage"]["tmp_name"]);
	$image_width = $image_info[0];
	$image_height = $image_info[1];
	
	//echo "$image_height"."$image_width";
	if($cur_age>=25){
		echo "<script> alert('Age Limit is below 25') </script>";
		header("Refresh:1; url=student.html");
	}
	elseif($UploadedFileName==''){
		echo "<script> alert('File Name cannot be empty') </script>";
		header("Refresh:1,url=student.html");
		die();
	}
	elseif(($_FILES["UploadImage"]["size"] > 500000)){
		echo "<script>alert('File size greater than 0.5MB')</script>";
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
	//create a folder MyUploadImages for storing images
	$upload_directory = "MyUploadImages/"; //This is the folder which you created just now
	$TargetPath=time().$UploadedFileName;
	
	$empty = 0;
	$q = mysqli_prepare($db,"INSERT INTO student(id,fullname,roll,email,contact,aadhar,address,pincode,
	source,destination,passno,classof,duration,branch,year,img_loc) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)") OR die($q->error);
	mysqli_stmt_bind_param($q,"isisiisissssssss",$empty,$fullname,$roll,$email,$contact,$aadhar,$address,$pincode,$source,$destination,$passno,$classof,$duration,$branch,$year,$TargetPath);
	if(mysqli_stmt_execute($q)){
		//echo "\nInserted into Table\n";
		if(move_uploaded_file($_FILES['UploadImage']['tmp_name'], $upload_directory.$TargetPath) ){
			echo "<strong> File and Details Uploaded  </n> </strong>";
		}
		else{
			$del_q = "DELETE FROM student WHERE email='$email' LIMIT 1";
			mysqli_stmt_execute($del_q); //execute stmt
		}
	}
	
	if($db->errno){
		//echo "$db->errno";
		die("\nEmail ID already Exists");
    }
	else{
		//echo "No errors";
		$sql_id = "SELECT id FROM student WHERE email='$email' LIMIT 1" ;
		$result = $db->query($sql_id);
		$row = $result->fetch_assoc();
		echo "<br/><br/> <div style='font-size:1.5em'>Your Enrollment ID is: ". $row['id'] ;
		echo "<br/> Please note the Enrollment ID for receiving your Concession Form". "</div>";
		
		//header("Refresh:2; url=student.html");
		}
	$db->close();
	}
}
?>
