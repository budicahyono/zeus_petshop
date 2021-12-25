<?php
$sql 		= "SELECT * FROM kategori";
$data 		= mysqli_query($conn, $sql);
$kategori 	= mysqli_num_rows($data);
?>