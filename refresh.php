<?php session_start();
include 'fungsi/base_url.php';
unset($_SESSION['session_chat']);
$_SESSION['session_chat'] = rand(100000,999999);
 header("location:".$base_url); 	

								  
  
?>