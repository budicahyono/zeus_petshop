<?php session_start(); 
include "../config.php"; 
include "../faktur.php"; 
include "../fungsi/base_url.php"; 
include "../fungsi/cek_session_public.php"; 
include "../fungsi/cek_login_public.php"; 

$cek		= "SELECT * FROM transaksi WHERE username = '$sesen_username' AND status ='0'";
$hasil 	= mysqli_query($conn,$cek);
$data 	= mysqli_fetch_array($hasil);

if(mysqli_num_rows($hasil) == 0)
{
	echo "<script>alert('Data tidak ditemukan');location.replace('../keranjang.html')</script>";
}
else
{
	$faktur 		= $data['notransaksi'];

	$query = "DELETE FROM transaksi_detail WHERE notransaksi = '$faktur' ";
	
	$cek		= "SELECT * FROM transaksi_detail WHERE notransaksi = '$faktur'";
	$hasil 	= mysqli_query($conn,$cek);
	while ($data 	= mysqli_fetch_array($hasil)) {

		$jumlah 		= $data['jumlah'];
		$id_produk 		= $data['id_produk'];
		
		$cari_barang  = "SELECT * FROM produk WHERE id_produk = '$id_produk' ";
		$hasil_barang = mysqli_query($conn, $cari_barang);
		$data_barang  = mysqli_fetch_array($hasil_barang);

		$stok         = $data_barang['stok'];
		
		$stok_tambah = $stok + $jumlah;
			$query_produk = mysqli_query($conn, "update produk SET stok = '$stok_tambah'
														WHERE id_produk = '$id_produk'");
		
		
	}
	
	if(mysqli_query($conn, $query)) 
  {
  	echo "<script>alert('Keranjang berhasil dikosongkan');location.replace('../keranjang.html')</script>";
  }  
  	else
  	{
  		echo "Error updating record: " . mysqli_error($conn);
  	}
}
?>