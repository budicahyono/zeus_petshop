<?php
//mengambil kota user yang membeli
$sesen_id         = $_SESSION['id_customer'];
$sql_kota_user 		= mysqli_query($conn,"SELECT kota FROM customer where id_customer =  $sesen_id ");
$data 							= mysqli_fetch_array($sql_kota_user);
$kota_user 			= $data['kota'];
?>