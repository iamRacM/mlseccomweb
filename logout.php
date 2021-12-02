<?php 
session_start();

if (!$_SESSION['emp_id']) {
    $_SESSION['err_msg'] = "<strong>Denied Access!</strong> Please login or contact the administrator.";
    header("location: index.php");
 }

if(isset($_SESSION['emp_id'])){
	session_destroy();
}

header("location:index.php");
?>