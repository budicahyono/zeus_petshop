<?php
$sql 	= "SELECT * FROM produk";
$data 	= mysqli_query($conn, $sql);
$produk = mysqli_num_rows($data);
?>