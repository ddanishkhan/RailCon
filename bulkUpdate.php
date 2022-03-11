<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
include 'logs/LOGGER.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    //database connection
    include('database_connection.php');
    
    //checking which button clicked
    if (isset($_POST['bulkIssueSubmit'])) {
        logger::log("INFO", "inside bulkIssueIds");
        print_r($_POST['bulkIssueIds']);        
        
        $multipleStudentIds = $_POST['bulkIssueIds'];
        
        if(!empty($multipleStudentIds)){
            $sql_update_status = "UPDATE student SET verified = 1 WHERE id IN ( $multipleStudentIds )";

            logger::log("QUERY", $sql_update_status);

            $db1 = OpenDatabaseConnection();
            $db1->query($sql_update_status);
            CloseDatabaseCon($db1);
        }
        else{
            logger::log("ERROR", "EMPTY IDS". $multipleStudentIds);
        }
        
         quickRedirect();
    }
    
    waitAndRedirect();
}
else{
    quickRedirect();
}

function quickRedirect(){
    logger::log("INFO", "Session Logged In [".$_SESSION['loggedin'] . "]|USER=[" .$_SESSION['user'] . "]" );
    
    if ($_SESSION['dashboard'] == true) {
        logger::log("INFO", "Redirected to dashboard.php");
        header("Location: dashboard.php");
    } else {
        logger::log("INFO", "Redirected to admin.php");
        header("Location: admin.php");
    }
}

function waitAndRedirect(){
    logger::log("INFO", "Session Logged In [".$_SESSION['loggedin'] . "]|USER=[" .$_SESSION['user'] . "]" );
    
    if ($_SESSION['dashboard'] == true) {
        logger::log("INFO", "Redirecting to dashboard.php");
        header("Refresh:0.5, url:dashboard.php");
    } else {
        logger::log("INFO", "Redirecting to admin.php");
        header("Refresh:0.5, url:admin.php");
    }
}

?>