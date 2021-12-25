<?php 
include '../config.php';              // Panggil koneksi ke database

$reg = $_GET['reg'];

if ($reg == "customer") {
	
	// proses update notif yang udah di liat untuk customer
	$query_notif = mysqli_query($conn, "UPDATE customer SET
										lihat		 = '1'
										WHERE lihat = '0'");
										
	header("location:customer.php");

} else if ($reg == "pesanan") { 

	// proses update notif yang udah di liat untuk pesanan
	$query_notif = mysqli_query($conn, "UPDATE transaksi SET
										lihat		 = '1'
										WHERE lihat = '0'");
										
	header("location:pesanan.php");

} else if ($reg == "pembayaran") { 

	// proses update notif yang udah di liat untuk pembayaran
	$query_notif = mysqli_query($conn, "UPDATE bayar SET
										lihat		 = '1'
										WHERE lihat = '0'");
										
	header("location:pembayaran.php");

}  else if ($reg == "testi") { 

	// proses update notif yang udah di liat untuk testi
	$query_notif = mysqli_query($conn, "UPDATE testimoni SET
										lihat		 = '1'
										WHERE lihat = '0'");
										
	header("location:testi_new.php");
	
}  else if ($reg == "diskusi") { 

	// proses update notif yang udah di liat untuk diskusi
	$query_notif = mysqli_query($conn, "UPDATE diskusi SET
										lihat		 = '1'
										WHERE lihat = '0'");
										
	header("location:diskusi_list.php");	
	
	
}	
	