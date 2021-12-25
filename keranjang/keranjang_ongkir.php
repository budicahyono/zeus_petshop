<?php
$sql_total_berat 		= mysqli_query($conn,"SELECT *  FROM ongkir WHERE notransaksi = '$faktur'");
$hasil 							= mysqli_fetch_array($sql_total_berat);


// isi API
$origin 			= $hasil['origin'];
$destination 		= $hasil['destination'];
$weight 			= $hasil['weight'];
$service 			= $hasil['service'];

?>