<?php 
if(isset($_SESSION['username']))
{
	$username = $_SESSION['username'];

	$cari 	= "SELECT * FROM transaksi WHERE username = '$username' AND status >='1' ORDER BY notransaksi DESC";
	$query 	= mysqli_query($conn,$cari);
	$hasil 	= mysqli_fetch_array($query);
	if($hasil > 0)
	{
		$faktur = $hasil['notransaksi'];
	}
}
?>