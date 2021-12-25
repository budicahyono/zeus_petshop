<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum

if(isset($_POST['submit']))
{
  $id_kat       = mysqli_real_escape_string($conn, $_POST['id_kat']);
  $judul_kat    = mysqli_real_escape_string($conn, $_POST['judul_kat']);

  $sql = "UPDATE kategori SET id_kat = '$id_kat', judul_kat = '$judul_kat' WHERE id_kat = '$id_kat' ";
                            
  if(mysqli_query($conn, $sql)) 
  {
    echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('kategori_list.php')</script>";
  } 
    else 
    {
      echo "Error updating record: " . mysqli_error($conn);
    }
}    
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
  } 
?>