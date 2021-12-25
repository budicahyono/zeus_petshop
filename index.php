
<?php 

session_start();                    // Memulai session
include 'config.php';                     // Panggil koneksi ke database
include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public
include 'fungsi/tgl_indo.php';            // Panggil fungsi merubah tanggal menjadi format seperti 

if (!isset($_GET['nav'])) {  $nav = "index"; }	else { $nav = $_GET['nav']; }
	

 
	
 if ($nav == "index") {
		$title = "Home";
		include "home/home.php";	

	} 

	else if ($nav == "katalog") {
		$title = "Katalog";
		include "produk/katalog.php";
		
	}
	
	
	

	else if ($nav == "keranjang") {
		$title = "Keranjang";
		include "keranjang/keranjang.php";
		
	}



	else if ($nav == "konfirmasi") {
		$title = "Konfirmasi";
		include "konfirmasi/konfirmasi.php";
		
	}
	
	else if ($nav == "konfirmasi_detail") {
		$title = "Detail Konfirmasi";
		include "konfirmasi/konfirmasi_detail.php";
		
	}
	
	else if ($nav == "kategori") {
		$title = "Kategori Produk";
		include "kategori/kategori.php";
		
	}

	

	else if ($nav == "register") {
		$title = "Registrasi";
		include "register/register.php";
		
	}
	
	else if ($nav == "login") {
		$title = "Login";
		include "register/login_form.php";
		
	}
	
	else if ($nav == "produk") {
		$title = "Produk";
		include "produk/produk.php";
		
	}
	
	else if ($nav == "diskusi") {
		$title = "Diskusi";
		include "diskusi/diskusi.php";
		
	}
	
	
	
	else if ($nav == "beli") {
		$title = "Beli";
		include "keranjang/beli.php";
		
	}
	
	else if ($nav == "checkout") {
		$title = "Checkout";
		include "keranjang/checkout.php";
		
	}
	
	else if ($nav == "transaksi_selesai") {
		$title = "Transaksi Selesai";
		include "keranjang/transaksi_selesai.php";
		
	}
	
	else if ($nav == "chat") {
		$title = "Proses Chat";
		include "proses_chat.php";
		
	}
	
	else if ($nav == "chat_list") {
		$title = "Proses Chat";
		include "chat_list.php";
		
	}

	else if ($nav == "refresh") {
		$title = "Refresh Chat";
		include "refresh.php";
		
	}	
	
	
	else if ($nav == "profil") {
		$title = "Profil Customer";
		include "profil.php";
		
	}	



?>