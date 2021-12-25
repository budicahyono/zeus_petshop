<?php session_start(); 										// Memulai session
include 'config.php'; 										// Memanggil koneksi ke database
include 'faktur.php'; 										// Memanggil faktur
include 'fungsi/base_url.php';  					// Memanggil fungsi base_url
include 'fungsi/cek_session_public.php'; 	// Memanggil fungsi cek_session_public
include 'fungsi/cek_login_public.php';  	// Memanggil fungsi cek_login_public


// Cek faktur pembelian berdasarkan notransaksi, username, dan status
$cek_faktur 	= mysqli_query($conn,"SELECT transaksi.notransaksi,transaksi.username,transaksi.status, 
								transaksi_detail.subtotal FROM transaksi_detail
								LEFT JOIN transaksi ON transaksi.notransaksi = transaksi_detail.notransaksi
								WHERE transaksi.notransaksi = '$faktur' AND transaksi.username = '$sesen_username' 
								AND transaksi.status = 0 ");
// Jika tidak ditemukan maka akan muncul alert/ pemberitahuan
if(mysqli_num_rows($cek_faktur) == 0)
{
	header("location:keranjang.html");
}
	// Apabila ditemukan maka lanjut proses checkout dengan mengupdate status menjadi 1, tanggal checkout hari itu 
	// berdasarkan notransaksi dan username
	else
	{
		
		$_SESSION['faktur']= $faktur;
		
	
		
		// ambil data dari form sebelumnya
			$origin = $_POST['origin'];
			$destination = $_POST['destination'];
			$weight = $_POST['weight'];
			$service = $_POST['service'];
	
			
			// proses simpan data ongkir
			$query_ongkir 	= "INSERT ongkir SET
								id_customer 		    = '$sesen_id',
								notransaksi 		    = '$faktur',
								origin 		        	= '$origin',
								destination 		    = '$destination',
								weight 	            	= '$weight',
								service 	            = '$service'";
			$sql_ongkir = mysqli_query ($conn, $query_ongkir); 
	

		
	
		
		
		
		if($sql_ongkir) 
	  {
		// Proses update
		$query = "UPDATE transaksi SET status = 1, tgl_checkout = now() 
							WHERE notransaksi = '$faktur' AND username = '$sesen_username' ";
		// Jika berhasil, maka akan diarahkan ke halaman transaksi selesai
		$sql = mysqli_query ($conn, $query); 
		//cari ongkir dulu  
		  
	  	header("location:$base_url"."transaksi_selesai.html");
	  }
	  	// Jika gagal, maka akan muncul alert
	  	else 
	  	{
	  		//echo "<script>alert('Mohon maaf, Transaksi gagal. Mohon ulangi kembali');location.replace('keranjang.html')</script>";
			echo mysqli_error($conn);
			
	  	} 
	}
?>