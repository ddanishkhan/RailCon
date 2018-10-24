<HTML>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php

?>
<script>
    $("document").ready( function () {
		
		swal({
		  title: "New Updates!",
		  text: "Rotation of the Image now Possible",
		  icon: "warning",
		})
		.then((willDelete) => {
		  if (willDelete) {
			swal("If any errors please contact the admin!", {
			  icon: "success",
			});
		  } else {
			swal("If any errors please contact the admin!", {icon: "success",});
		  }
		});
    }); 
</script>
<?php

?>

<?php
if(isset($_GET['updated'])){
include 'database_connection.php' ;
echo "OK";
$sql_update_status = "UPDATE members SET alertuser = 1 ";
$db->query($sql_update_status);
}
?>

</HTML>