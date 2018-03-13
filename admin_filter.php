<?php
    $db = new mysqli("localhost","root","","railcon");

	if($db->connect_errno){die('Database connection failed.');}
    echo "<html>
        <head>
	        <title>Admin Panel</title>
	    </head>
		<link rel='stylesheet' type='text/css' href='indadmstu.css' />
		<style>
		li.a_align, a.button{
		list-style-type: none;
		text-decoration: none;
		}
		</style>
		
	<body>
	<ul class='form-style-1'>	
	<h1>Admin Panel</h1>
	<fieldset>
	
	<form action='admin.php' name='filter_form' method='POST'>
		<li>
		<label>Select records to display:</label>  
		<select name='filter'>
		<option value='Not_Issued'>Not Issued Forms</option>
		<option value='Issued'>Issued Forms</option>
		<option value='Males'>Male Student Forms</option>
		<option value='Females'>Female Student Forms</option>
		</select><br/>
		<input type='submit' name='filter_submit' value='Show Records'/>
		</li>
    </form>" ;
	
	
	
	$sql_display = "SELECT DISTINCT DATE_FORMAT(dateofentry, '%d/%m/%Y') as date FROM student";
	$result = $db->query($sql_display);
	if($result->num_rows > 0)
	{
	    echo "<form action='admin.php' name='filter_form1' method='POST'>
		        <li>
				<label>Select records to display by date:</label>
		    	<select name='date_filter'>";
		while($row = $result->fetch_assoc())
			{
				echo "<option value='". $row['date'];
				echo "' >";
				
				echo $row['date'];
				//echo date("d/m/y", strtotime($row["dateofentry"])); 
				echo "</option>";
			}
			echo "</select><br/><input type='submit' name='date_submit' value='Show Records'/>
				</li>
			</form>";
	}		
	
	echo "<form action='search.php' name='search_s' method='GET'>
		<li>
		<label>Search the Records</label>
		<input type='text' name='query' /><br/>
		<input type='submit' value='Search' /></li>
	</form>
	
	</ul>			
	</fieldset>

	<li class='a_align'><a href='http://localhost/Railcon/dashboard.php' class='button' > 
			View All Records</a>
	</li>			
	
	</body>
</html>";
?>