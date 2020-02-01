<?php

	$statusSelected = 'def';
	$genderSelected = 'def';
	$deptSelected = 'def';
	$train_classSelected = '';
	$durationSelected='';
	$dates=[];
	
	$sql_date = "SELECT DISTINCT DATE_FORMAT(dateofentry, '%d/%m/%Y') as date FROM student ORDER BY dateofentry DESC";
	$sql_date_rs = $db->query($sql_date);
	if($sql_date_rs->num_rows > 0){
		while($rw = $sql_date_rs->fetch_assoc()){
			array_push($dates, $rw['date']);
		}
	}
	
if(isset($_SESSION['query'] )){
	$queryFound = $_SESSION['query'] ;
	
	if( preg_match("/verified=1/", $queryFound) ){		
		$statusSelected = 'issued';
	}
	else if(preg_match("/verified=0/", $queryFound)){
		$statusSelected = 'notIssued';
	}
	
	if( preg_match("/gender=0/", $queryFound)){
		$genderSelected = 'M';
	}else if( preg_match("/gender=1/", $queryFound)){
		$genderSelected = 'F';
	}
	
	if( preg_match('/branch = "Automobile"/', $queryFound)){
		$deptSelected = 'A';
	}else if( preg_match('/branch = "Information Technology"/', $queryFound)){
		$deptSelected = 'IT';
	}else if( preg_match('/branch = "Computer/', $queryFound)){
		$deptSelected = 'CS';
	}else if( preg_match('/branch = "Civil"/', $queryFound)){
		$deptSelected = 'C';
	}else if( preg_match('/branch = "Electronics"/', $queryFound)){
		$deptSelected = 'EX';
	}else if( preg_match('/branch = "Mechanical"/', $queryFound)){
		$deptSelected = 'M';
	}else if( preg_match('/branch = "Electronics & Telecommunications"/', $queryFound)){
		$deptSelected = 'EXTC';
	}
	
	if( preg_match('/classof = "First"/', $queryFound)){
		$train_classSelected= 'F';
	}else if( preg_match('/classof = "Second"/', $queryFound)){
		$train_classSelected= 'S';
	}
	
	if( preg_match('/duration = "Quarterly"/', $queryFound)){
		$durationSelected= 'Q';
	}else if( preg_match('/duration = "Monthly"/', $queryFound)){
		$durationSelected= 'M';
	}
	
}

?>

<form action='admin.php' name='filter_form' method='POST'>

	<div class="form-inline">
	  <div class="form-group col-lg-12">
	  
		<select class="form-control" name='status'>
		<option value='def'>Status</option>
		<option <?php if($statusSelected=='notIssued') echo 'selected' ?> value='NI'>Not Issued Forms</option>
		<option <?php if($statusSelected=='issued') echo 'selected' ?> value='I'>Issued Forms</option>
		</select>
		
		<select class='form-control' name='gender'>
		<option value='def'>Gender</option>
		<option <?php if($genderSelected=='M') echo 'selected' ?> value='M'>Male Student Forms</option>
		<option <?php if($genderSelected=='F') echo 'selected' ?> value='F'>Female Student Forms</option>
		</select>
	  
		<select class='form-control' name="dept">
		<option value='def' >Department</option>
		<option <?php if($deptSelected=='A') echo 'selected' ?> value='A'>Automobile</option>
		<option <?php if($deptSelected=='IT') echo 'selected' ?> value='IT'>Information Technology</option>
		<option <?php if($deptSelected=='C') echo 'selected' ?> value='C'>Civil</option>
		<option <?php if($deptSelected=='M') echo 'selected' ?> value='M'>Mechanical</option>
		<option <?php if($deptSelected=='EXTC') echo 'selected' ?> value='EXTC'>Electronics & Telecommunications</option>
		<option <?php if($deptSelected=='CS') echo 'selected' ?> value='CS'>Computer Science</option>
		<option <?php if($deptSelected=='EX') echo 'selected' ?> value='EX'>Electronics Engineer</option>
		<br/>
		</select>
		
		<select class='form-control' name='train_class'>
		<option value='def'>Train Class</option>
		<option <?php if($train_classSelected=='F') echo 'selected' ?> value='F'>First</option>
		<option <?php if($train_classSelected=='S') echo 'selected' ?> value='S'>Second</option>
		</select>
		
		<select class='form-control' name='duration'>
		<option value='def'>Duration</option>
		<option <?php if($durationSelected=='Q') echo 'selected' ?> value='Q'>Quaterly</option>
		<option <?php if($durationSelected=='M') echo 'selected' ?>  value='M'>Monthly</option>
		</select>
		
		<select class='form-control'  name='date_filter'>
		<option value='def'>Date</option>
		<?php foreach($dates as $date){	?>	  
		<option value=<?php echo $date ?>> <?php echo $date?> </option>
		
		<?php	}	?>
		</select>
	  
	  </div>
	</div>
		<button class="form-group form-control btn btn-outline-secondary" name='filter_submit' value='Search' type="submit">Search</button>
</form>