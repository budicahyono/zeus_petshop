<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum

$id   = mysqli_real_escape_string($conn, $_GET['id']);

$sql = "DELETE FROM chatting WHERE id_chatting = '$id' ";
if (mysqli_query($conn, $sql)) 
{
	
  echo "<script>alert('Hapus data berhasil! Klik ok untuk melanjutkan');location.replace('chatting.php')</script>"; 
}
  else 
  {
    echo "Error updating record: " . mysqli_error($conn);
  }
?>