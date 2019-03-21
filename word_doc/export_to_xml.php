<?php
$filename = $_SESSION['student_name'].".xml";
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Content-Type: text/xml');

/*What we echo will be saved in document*/
readfile('word_doc/populated.xml');
?>