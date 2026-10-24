<HTML>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php

?>
<script>
    $("document").ready( function () {
		
		swal({
		  title: "New Updates!",
		  text: "Delete Function Enabled",
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