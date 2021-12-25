<?php
if(isset($_SESSION['username']))
{
	$sesen_id_user	= $_SESSION['id_user']; 
	$sesen_nama 	= $_SESSION['nama'];
	$sesen_username = $_SESSION['username'];
	$sesen_usertype = $_SESSION['usertype'];
	
	$sql              = "SELECT * FROM user WHERE id_user = '$sesen_id_user' ";
	$result           = mysqli_query($conn, $sql);
	$data             = mysqli_fetch_array($result);
	$sesen_foto 	  = $data['foto'];
	
	
}
?>