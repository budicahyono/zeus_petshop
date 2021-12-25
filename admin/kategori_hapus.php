<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum

$id_kat   = mysqli_real_escape_string($conn, $_GET['id_kat']);

$sql = "DELETE FROM kategori WHERE id_kat = '$id_kat' ";
if (mysqli_query($conn, $sql)) 
{
  echo "<script>alert('Hapus data berhasil! Klik ok untuk melanjutkan');location.replace('kategori_list.php')</script>"; 
}
  else 
  {
      echo "Error updating record: " . mysqli_error($conn);
  }
?>