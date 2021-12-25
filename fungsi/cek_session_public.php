<?php
if(isset($_SESSION['username']))
{
 if (isset($_SESSION['usertype'])) {
	 header("location:admin/home.php");
 }	else {
	  $sesen_id         = $_SESSION['id_customer'];
	  $sesen_username   = $_SESSION['username'];
	  $sesen_nama       = $_SESSION['nama'];
	  $sesen_kota       = $_SESSION['kota'];
	  
	  
 }
}
?>