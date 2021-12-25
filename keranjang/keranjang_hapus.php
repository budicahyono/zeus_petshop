<?php session_start(); 
include "../config.php"; 
include "../faktur.php"; 
include "../fungsi/base_url.php"; 
include "../fungsi/cek_session_public.php"; 
include "../fungsi/cek_login_public.php"; 

$id_produk 	= $_GET['id'];

$cek		= "SELECT * FROM transaksi_detail WHERE username = '$sesen_username' AND id_produk ='$id_produk' AND notransaksi = 
			   '$faktur'";
$hasil 	= mysqli_query($conn,$cek);
$data 	= mysqli_fetch_array($hasil);

if(mysqli_num_rows($hasil) == 0)
{
	echo "<script>alert('Data tidak ditemukan');location.replace('../keranjang.html')</script>";
}
else
{
	$jumlah 		= $data['jumlah'];
	
	$query = "DELETE FROM transaksi_detail WHERE notransaksi = '$faktur' AND id_produk = '$id_produk' ";
	
	
	$cari_barang  = "SELECT * FROM produk WHERE id_produk = '$id_produk' ";
	$hasil_barang = mysqli_query($conn, $cari_barang);
	$data_barang  = mysqli_fetch_array($hasil_barang);

	$stok         = $data_barang['stok'];
	
	$stok_tambah = $stok + $jumlah;
		$query_produk = mysqli_query($conn, "update produk SET stok = '$stok_tambah'
													WHERE id_produk = '$id_produk'");
	
	if(mysqli_query($conn, $query)) 
  {
  	echo "<script>alert('Barang berhasil dihapus');location.replace('../keranjang.html')</script>";
  }  
  	else
  	{
  		echo "Error updating record: " . mysqli_error($conn);
  	}
}
?>