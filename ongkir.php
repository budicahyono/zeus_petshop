<?php
include 'config.php'; 
$cek = "SELECT * FROM kabkot inner join customer on customer.kota = kabkot.id_kabkot
		WHERE customer.username = '$sesen_username'";
$hasil = mysqli_query($conn,$cek);
while ($data=mysqli_fetch_array($hasil))
{
	echo "".number_format($data['jne_reg'], 0, ',', '.').",-";
} 
?>