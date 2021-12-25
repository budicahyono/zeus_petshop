<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum

$id   = mysqli_real_escape_string($conn, $_GET['id']);
$chat   = mysqli_real_escape_string($conn, $_GET['chat']);

$sql = "DELETE FROM chatting_detail WHERE id_chatting_detail = '$id' ";
if (mysqli_query($conn, $sql)) 
{
	
  echo "<script>alert('Hapus data berhasil! Klik ok untuk melanjutkan');location.replace('chatting_detail.php?id=$chat')</script>"; 
}
  else 
  {
    echo "Error updating record: " . mysqli_error($conn);
  }
?>