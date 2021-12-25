<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum

if(isset($_POST['submit']))
{
  $judul_kat    = mysqli_real_escape_string($conn, $_POST['judul_kat']);

  $cekdata = "SELECT judul_kat FROM kategori WHERE judul_kat = '$judul_kat' ";
  $ada     = mysqli_query($conn, $cekdata);
  if(mysqli_num_rows($ada) > 0)
  { 
    echo "<script>alert('ERROR: Judul telah terdaftar, silahkan pakai Judul lain!');history.go(-1)</script>";
  }
    else
    {
      // Proses insert data dari form ke db
      $sql = "INSERT INTO kategori (judul_kat) VALUES ('$judul_kat')";

      if(mysqli_query($conn, $sql)) 
      {
        echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('kategori_list.php')</script>";
      } 
        else 
        {
          echo "Error updating record: " . mysqli_error($conn);
        }
    }
}
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
  }
?>