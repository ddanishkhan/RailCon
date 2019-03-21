<?php
require 'database_connection.php' ;

/*Student Details*/
$sql_display = "SELECT id, fullname, gender, branch, DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, source, destination, passno,pass_end ,voucher,season,classof, duration, verified,img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date FROM student WHERE id=".$_SESSION['student_id'];

$results = $db->query($sql_display);

if ($results->num_rows > 0) {
	while ($row = $results->fetch_assoc()) {
		
		$studentName = $row['fullname'];
		$_SESSION['student_name'] = $studentName;
		$stud_branch = $row['branch'];
		
		$diff = date_diff(date_create(), date_create($row['DOB']) );
		$stud_ageYear = $diff->format("%Y");
		$stud_ageMonth = $diff->format("%M");

		$stud_src = $row['source'];
		$stud_dest = $row['destination'];
	
		$stud_prevPassNo =$row['passno'] ;
		$stud_passEndDate = date_create($row['pass_end']) ;
		$stud_passEnd = $stud_passEndDate->format("d/m/Y");
		$stud_voucher =$row['voucher'] ;
		
		if( !isset($stud_voucher)){
			$stud_voucher = "";
		}				
		if( !isset($stud_prevPassNo)){
			$stud_prevPassNo = "";
		}

		if( !checkdate($stud_passEndDate->format("m"), $stud_passEndDate->format("d"), $stud_passEndDate->format("Y")) ){
			$stud_passEnd = "";
		}
		//$stud_season = $row['season'] ; same as passno
		$stud_class = $row['classof'];
		$stud_period = $row['duration'];
	}
}

/*Replace and Save the file*/
$xml = simplexml_load_file('word_doc/Railcon_XML_test.xml');

$searches = ['student_name', 'branch_name', 'class', 'season_no', 'pass_end', 
	'vch_no', 'period', 'src_stn', 'dest_stn', 'age_y', 'age_m']; 
$replacements = [$studentName, $stud_branch, $stud_class, $stud_prevPassNo, $stud_passEnd, 
	$stud_voucher, $stud_period, $stud_src, $stud_dest, $stud_ageYear, $stud_ageMonth  ];

$newXml = simplexml_load_string( str_replace( $searches, $replacements, $xml->asXml() ) );
$newXml->asXml('word_doc/populated.xml');

?>