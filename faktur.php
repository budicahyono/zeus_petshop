<?php 
include "fungsi/cek_session_public.php"; 
include "fungsi/cek_login_public.php"; 

$cari  = "SELECT * FROM transaksi WHERE username = '$sesen_username' AND status = 0 ORDER BY notransaksi DESC";
$query = mysqli_query($conn,$cari);
$cek = mysqli_num_rows($query);
$hasil = mysqli_fetch_array($query);

if($cek != 0)
{
	$faktur = $hasil['notransaksi'];
}
else
{
	$query_input 	= "INSERT INTO transaksi (username,tgl_checkout,status) VALUES ('$sesen_username',now(),'0')";
	$result_input = mysqli_query($conn,$query_input);

	$cari  = "SELECT * FROM transaksi WHERE username = '$sesen_username' AND status = 0 ORDER BY notransaksi DESC";
	$query 	= mysqli_query($conn,$cari);
	$cek = mysqli_num_rows($query);
	$hasil 	= mysqli_fetch_array($query);
	
	if($cek != 0)
	{
		$faktur = $hasil['notransaksi'];
	}
}
?>