<?php

if(isset($_POST['submit']))
{
	/*
	
	Query for table creation.
	Create a folder for images called UploadImage
	
CREATE TABLE `student` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `fullname` varchar(30) NOT NULL,
 `gender` tinyint(1) NOT NULL,
 `semester` tinyint(2) unsigned NOT NULL,
 `email` varchar(30) NOT NULL,
 `DOB` date NOT NULL,
 `contact` bigint(15) unsigned NOT NULL,
 `aadhar` bigint(15) unsigned NOT NULL,
 `address` varchar(50) NOT NULL,
 `pincode` mediumint(6) unsigned NOT NULL,
 `source` varchar(20) NOT NULL,
 `destination` varchar(20) NOT NULL,
 `passno` varchar(20) DEFAULT NULL,
 `pass_end` date DEFAULT NULL,
 `voucher` varchar(20) DEFAULT NULL,
 `season` int(20) DEFAULT NULL,
 `classof` varchar(20) NOT NULL,
 `duration` varchar(20) NOT NULL,
 `branch` varchar(20) NOT NULL,
 `year` varchar(20) NOT NULL,
 `img_loc` varchar(50) NOT NULL,
 `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
 `dateofentry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `datetodelete` timestamp NULL DEFAULT NULL,
 `Remark` varchar(50) NOT NULL DEFAULT 'No Remarks',
 PRIMARY KEY (`id`),
 UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
	
	*/
	
	session_start();
	$db = new mysqli("localhost","root","","railcon");
	if($db->connect_errno)
	{	die("Database Connection failed"); }

	$fullname= $_POST['name'];
	$gender = $_POST['gender']; // 0 for male, 1 female
	$sem    = $_POST['semester']; //roll is semester
	$email   = $_POST['email'];
	$contact = $_POST['contact']; 
	$aadhar  = $_POST['aadhar'];
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
		header("Refresh:1;url=student.html");
		die();
	}
	elseif(($_FILES["UploadImage"]["size"] > 500000)){
		echo "<script>alert('File size greater than 0.5MB')</script>";
		header("Refresh:1; url=student.html");
		die();
	}
	elseif( $image_height<500 || $image_width<300 ){
		echo "<script>alert('Minimum Image Resolution widthxheight : 300x500')</script>";
		header("Refresh:0.5; url=student.html");
		die();
	}
	else
	{
	 //create a folder MyUploadImages for storing images
	 $upload_directory = "MyUploadImages/"; //This is the folder which you created just now
	 $TargetPath=time().$UploadedFileName;
	
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
				
		}//ok
		else{
			$del_q = "DELETE FROM student WHERE email='$email' LIMIT 1";
			mysqli_stmt_execute($del_q); //execute stmt
		}//ok
	 }//end if mysqli_stmt
	 
	if($db->errno){ echo $db->error ; die("Error Email Exists"); }
	
	elseif($db->errno){ echo $db->error ; die("Error Email Exists"); }
	 else{
		//echo "No errors";
		$sql_id = "SELECT id FROM student WHERE email='$email' LIMIT 1" ;
		$result = $db->query($sql_id);
		$row = $result->fetch_assoc();
		echo "<br/><br/> <div style='font-size:1.5em'>Your Enrollment ID is: ". $row['id'] ;
		echo "<br/> Please note the Enrollment ID for receiving your Concession Form". "</div>";
		
		//header("Refresh:2; url=student.html");
		} //ok end
		
	$db->close();
	}// end else for insertion
}
?>