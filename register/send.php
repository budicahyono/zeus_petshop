<?php
include '../config.php';
include '../fungsi/base_url.php';

$sql_admin 		= mysqli_query($conn,"SELECT *  FROM user WHERE id_user = '1' ");
$hasil_admin 							= mysqli_fetch_array($sql_admin);


// isi admin
$nama_admin 			= $hasil_admin['nama'];
$no_rek_admin 			= $hasil_admin['no_rek'];
$bank_admin 			= $hasil_admin['bank'];
$no_hp_admin 			= $hasil_admin['no_hp'];

if(isset($_POST['submit']))
{
  $nama       = mysqli_real_escape_string($conn,$_POST['nama']);
  $username   = mysqli_real_escape_string($conn,$_POST['username']);
  $email      = mysqli_real_escape_string($conn,$_POST['email']);
  $password   = $_POST['password'];
  $telepon    = mysqli_real_escape_string($conn,$_POST['telepon']);
  $alamat     = mysqli_real_escape_string($conn,$_POST['alamat']);
  $kopos      = mysqli_real_escape_string($conn,$_POST['kopos']);
  $prov       = mysqli_real_escape_string($conn,$_POST['prov']);
  $kot        = mysqli_real_escape_string($conn,$_POST['kot']);
 
  $sql        = "SELECT * FROM customer WHERE email = '$email' and status = 1 ";
  $cek_email  = mysqli_query($conn,$sql);
  if(empty($nama))
  {
    echo "<script>alert('Nama harus diisi!');history.go(-1)</script>";
  }
  elseif(empty($username))
  {
    echo "<script>alert('Username harus diisi!');history.go(-1)</script>";
  }
  elseif(empty($email))
  {
    echo "<script>alert('email harus diisi!');history.go(-1)</script>";
  }
  elseif(empty($password))
  {
    echo "<script>alert('password harus diisi!');history.go(-1)</script>";
  }
  elseif(empty($telepon))
  {
    echo "<script>alert('telepon harus diisi!');history.go(-1)</script>";
  }
  elseif(mysqli_num_rows($cek_email) > 0)
  {
    // Alert/ pemberitahuan email yang dipakai telah ada/ tidak
    echo "<script>alert('Email telah terpakai, silahkan gunakan email yang lain!');history.go(-1)</script>";
  }
    else
    {      
      // Membuat kode unik untuk aktivasi akun dengan format md5
     // ------hapus hash----
      
     

      // Proses insert data customer
      $create = "INSERT INTO customer ( nama,
                                        username,
                                        email,
                                        password,
                                        telepon,
                                        alamat,
                                        kopos,
                                        provinsi,
                                        kota,
                                        status)
                                VALUES ('$nama',
                                        '$username',
                                        '$email',
                                        '$password',
                                        '$telepon',
                                        '$alamat',
                                        '$kopos',
                                        '$prov',
                                        '$kot',
                                        '0')";
										
	

      if (mysqli_query($conn, $create)) 
      {
        echo "<script>alert('Registrasi berhasil! Silahkan tunggu kurang dari 30 menit untuk Kami verifikasi, jika belum bisa login, silahkan hubungi kami di Nomor WA $no_hp_admin ($nama_admin)');location.replace('..')</script>";
      } 
      else 
      {
        echo "Error updating record: " . mysqli_error($conn);
      }
    }
}
?>