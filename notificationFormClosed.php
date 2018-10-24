<HTML>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$nuum = $_SESSION['endnumber'];

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