                    <div class="card-body">
                      <div class="table-responsive">   
                        <table class="table table-striped table-sm">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Gender</th>
                              <th>Age</th>
							  <th>Source</th>
							  <th>Destination</th>
							  <th>Passno</th>
							  <th>Class</th> 
							  <th>Duration</th> 
							  <th>DateOfEntry</th> 
							  <th>Status</th> 
							  <th>ID Card</th> 
							  <th>Issue</th> 
							  <th>Remarks</th> 
                            </tr>
                          </thead>
						  <tbody>
</html>

<?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
			
            echo "<tr><th scope='row'>" . $idd = $row['id'];
            echo '</th><td>';
			echo "<a href='complete_data.php?student=".$idd."'>";
			echo $row['fullname'];
			echo "</a>";
            echo "</td><td>";
            if ($row['gender'] == '1')
                echo "Female";
            else
                echo "Male";
            echo "</td><td>";
			
			$diff = date_diff(date_create(), date_create($row['DOB']) );
			echo $row['dateOB'];
			echo "<br/>";
			echo "--- <br>";
			echo $diff->format("%Y Y %M M");
			
            echo "</td><td>";
            echo $row['source'];
            echo "</td><td>";
            echo $row['destination'];
            echo "</td><td>";
            echo $row['passno'] . "<br/>";
            echo $row['pass_end'] . "<br/>";
            echo $row['voucher'] . "<br/>";
            echo $row['season'] . "<br/>";
            echo "</td><td>";
            echo $row['classof'];
            echo "</td><td>";
            echo $row['duration'];
            echo "</td><td>";
            echo $row['date'];
            echo "</td><td>";
            if ($row['verified'] == "1")
                echo "Issued";
            else
                echo "Not Issued";
            echo "</td><td>";
            $MyPhoto = $row['img_loc'];
            			$MyPhoto = $row['img_loc'];
			
			echo "<img id='img".$idd."' src = 'MyUploadImages/".$MyPhoto."' data-toggle='modal' data-target='#myModal' height='100'/>";
		
?>
	<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style = "max-width:90%; max-height:90%">
        <div class="modal-content">
            <div class="modal-body ">
				<div class="image-wrapper">
                 <img class="showimage img-responsive" src="" style = "max-width:90%; max-height:700px"/>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-default rotate">Rotate</button>
            </div>
        </div>
    </div>
</div>
			
<script src="http://code.jquery.com/jquery.min.js"></script>
<script>
var rotation = 0

$('img').on('click', function () {
    var image = $(this).attr('src');
    $('.showimage').attr('src', image);
    rotation = 0;
    rotate(0)
    $('#myModal').modal('show');
});

$('.rotate').on('click', function () {
      rotation += 45;
      rotate(rotation)
});

function rotate(deg) {
  $('.showimage').css({
      '-webkit-transform' : 'rotate('+ deg +'deg)',
      '-moz-transform' : 'rotate('+ deg +'deg)',
      '-ms-transform' : 'rotate('+ deg +'deg)',
      'transform' : 'rotate('+ deg +'deg)'
  });
}
	
</script>

            </td>
		<td>
			
			<form action='update.php' method='POST'>
			<input type='hidden' name = 'id' value = "<?php echo $idd ?>">
			<input type = 'submit' class='bg-green' name= 'verify_it' value='Issue'><br/>
			<input type = 'submit' class='bg-red' name= 'cancel_verify' value='Not Issue'><br/>
			</form></br>
			
			<form action='edit.php' method='POST'>
			<input type='hidden' name = 'id' value = "<?php echo $idd ?>">
			<input type = 'submit' class='bg-blue' name= 'edit' value ='Edit Record'></br>
			</form>
			

			<form action='delete.php' method='POST' onsubmit="return confirm('Are you sure you want to delete?');" >
			<input type='hidden' name = 'id' value = "<?php echo $idd ?>">	
			<input type = 'submit' class='bg-red' name= 'delete' value ='Delete Record'>
			</form>
			
            <form action='editform.php' method='POST' >
			<input type='hidden' name = 'id' value = "<?php echo $idd ?>">
			<input type = 'submit' class='bg-green' name= 'edit_form' value ='Allow Edit'/>
			</form>
            
		</td><td>
		
		<form id='Remarks' method='POST' action='update_remark.php'>
		<input type='text' name='remark' placeholder='Enter Remarks' style='width:90%'/>
		<input type='hidden' name = 'id' value = "<?php echo $idd ?>"></input>
		<input type='submit' class='bg-blue' name='update_remark' value='Remark' style='width:80%;'/>
		</form>
		</td></tr>
<?php
        }
    } //$result->num_rows > 0
	else {
    echo "<strong style='font-size:2em'>No Records</strong>";
    }
?>
<html>						  
                            <tr>
                              <th scope="row">-</th>
                              <td>-</td>
                              <td>---</td>
                              <td>---</td>
							  <td>---</td>
                              <td>---</td>
                              <td>---</td>
                              <td>---</td>
                              <td>---</td>
                              <td>---</td>
							  <td>---</td>
                              <td>---</td>
                              <td>---</td>
							  <td>---</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>