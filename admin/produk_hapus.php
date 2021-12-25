<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum

$id_produk   = mysqli_real_escape_string($conn, $_GET['id_produk']);

$del_img  = "SELECT img FROM produk WHERE id_produk = '$id_produk' ";
$res      = mysqli_query($conn, $del_img);
$data     = mysqli_fetch_array($res);
$img   		= $data['img'];
$tmpfile 	= "../images/produk/$img";

$sql = "DELETE FROM produk WHERE id_produk = '$id_produk' ";
if (mysqli_query($conn, $sql)) 
{
	unlink ($tmpfile);
  echo "<script>alert('Hapus data berhasil! Klik ok untuk melanjutkan');location.replace('produk_list.php')</script>"; 
}
  else 
  {
    echo "Error updating record: " . mysqli_error($conn);
  }
?>