<?php
$sql 	= "SELECT * FROM testimoni WHERE status = '2' ";
$data 	= mysqli_query($conn, $sql);
$testinew 	= mysqli_num_rows($data);
?>