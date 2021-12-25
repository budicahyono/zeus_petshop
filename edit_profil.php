<?php
include 'config.php';
include 'fungsi/base_url.php';

$sql_admin 		= mysqli_query($conn,"SELECT *  FROM user WHERE id_user = '1' ");
$hasil_admin 							= mysqli_fetch_array($sql_admin);


// isi admin
$nama_admin 			= $hasil_admin['nama'];
$no_rek_admin 			= $hasil_admin['no_rek'];
$bank_admin 			= $hasil_admin['bank'];
$no_hp_admin 			= $hasil_admin['no_hp'];

if(isset($_POST['submit']))
{
  $id_customer= mysqli_real_escape_string($conn,$_POST['id_customer']);
  $nama       = mysqli_real_escape_string($conn,$_POST['nama']);
  $username   = mysqli_real_escape_string($conn,$_POST['username']);
  $telepon    = mysqli_real_escape_string($conn,$_POST['telepon']);
  $email      = mysqli_real_escape_string($conn,$_POST['email']);
  $password   = $_POST['password'];
  $alamat     = mysqli_real_escape_string($conn,$_POST['alamat']);
  $prov       = mysqli_real_escape_string($conn,$_POST['prov']);
  $kot        = mysqli_real_escape_string($conn,$_POST['kot']);
  $kopos      = mysqli_real_escape_string($conn,$_POST['kopos']);
 
  
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
    else
    {      
      // Membuat kode unik untuk aktivasi akun dengan format md5
     // ------hapus hash----
      
     

      // Proses edit data customer
      $edit = "UPDATE customer SET  nama = '$nama',
                                      username = '$username',
                                      email = '$email',
                                      password = '$password',
                                      telepon = '$telepon',
                                      alamat = '$alamat',
                                      kopos = '$kopos',
                                      provinsi = '$prov',
                                      kota = '$kot'
								WHERE id_customer = '$id_customer'";
										
	

      if (mysqli_query($conn, $edit)) 
      {
        echo "<script>alert('Edit Customer berhasil!');location.replace('.')</script>";
      } 
      else 
      {
        echo "Error updating record: " . mysqli_error($conn);
      }
    }
}
?>