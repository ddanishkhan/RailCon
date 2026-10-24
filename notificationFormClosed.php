<HTML>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$nuum = $_SESSION['endnumber'] ?? '100 (sample)'; // direct visit has no session value

?>
<script>
$("document").ready( function () {
		
	swal({
	  title: "Form For Students is closed",
	  text: "Form Ends At Number <?php echo $nuum; ?>",
	  icon: "warning",
	  buttons: [ "Ok", "Change Number!"],
	})
	.then((willDelete) => {
	  if (willDelete) {
		window.location.href='admin_filter.php';
	  } else {
		window.location.href='admin.php';
	  }
	});
	
}); 
</script>

</HTML>