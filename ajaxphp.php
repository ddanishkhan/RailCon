<?php

include('database_connection.php');


if (isset($_GET['verify_it'])) {

//$db=mysqli_connect('localhost','id5617200_railcon', 'lightbulb17' ,'id5617200_railcon');

$var_id = $_POST['id'];

$status_check = "SELECT verified FROM student WHERE id = '$var_id' LIMIT 1";

$s_check = $db->query($status_check);

$s_value = $row = $s_check->fetch_assoc();
echo $s_value['verified'];
  if($s_value['verified'] == "0")

  {

  $sql_update_status = "UPDATE student SET verified = 1 WHERE id='$var_id' ";

  $db->query($sql_update_status);
  echo "Card Issued";
  exit();

  }

  else{

echo "Card Already Issued";

}

}


?>
