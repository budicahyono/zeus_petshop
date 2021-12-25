<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session

$nama  = $_POST['nama'];
$username  = $_POST['username'];
$id_user  = $_POST['id_user'];
$pswlama  = $_POST['pswlama'];
$no_rek  = $_POST['no_rek'];
$bank  = $_POST['bank'];
$no_hp  = $_POST['no_hp'];

$pswbaru  = password_hash($_POST['pswbaru'], PASSWORD_DEFAULT);

$width_size = 50; //ukuran width_size struk
 $allowed_ext    = array('jpg', 'jpeg', 'png', 'gif');
  $file_name      = $_FILES['foto']['name']; // file yg di upload
  if ($file_name != "" ) {
	$nama_file      = $file_name; // nama file
  } else {
	$nama_file      = $_POST['foto_hidden']; // nama file
  }
  $tmp			  = explode('.', $nama_file);
  $file_ext       = strtolower(end($tmp));
  $file_size      = $_FILES['foto']['size'];
  $file_tmp       = $_FILES['foto']['tmp_name'];
  $lokasi         = "../images/$username.$file_ext";
  $foto            = $username.'.'.$file_ext;
  $dir_upload 		= "../images/";
  $filesave = $dir_upload . $foto;
  
  if(!empty($file_tmp))
  {
    if(in_array($file_ext, $allowed_ext) === true)
    {
      //Hapus photo yang lama jika ada
      $del  = "SELECT foto FROM user WHERE id_user = '$id_user' ";
      $res  = mysqli_query($conn, $del);
      $d    = mysqli_fetch_object($res);
      if(strlen($d->foto)>3)
      if(file_exists($d->foto))
      {
        // Memutuskan koneksi file yang lama
        unlink($d->foto);
        unlink("../images/resize_".$d->foto);
      }
      move_uploaded_file($file_tmp, $lokasi);
	  
	  // menentukan nama image setelah dibuat
$resize_image = $dir_upload . "resize_" . $username. ".".$file_ext;		
 
 // mendapatkan ukuran width dan height dari image
list( $width, $height ) = getimagesize($filesave);

// mendapatkan nilai pembagi supaya ukuran skala image yang dihasilkan sesuai dengan aslinya
$bagi = $width / $width_size;

// menentukan width yang baru
$newwidth = $width / $bagi;

// menentukan height yang baru
$newheight = $height / $bagi;

// fungsi untuk membuat image yang baru
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imagecreatefromjpeg($filesave);

// men-resize image yang baru
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

// menyimpan image yang baru
imagejpeg($thumb, $resize_image);

imagedestroy($thumb);
imagedestroy($source);
	  
	  
      // Update photo dengan yang baru
      $update = "UPDATE user SET foto = '$foto' WHERE id_user = '$id_user' ";
      $upd = mysqli_query($conn, $update);
    } 
      else
      {
        echo "<script>alert('Format file tidak sesuai!');history.go(-1)</script>";
      } 
  }
  
$cari     = "SELECT * FROM user WHERE id_user = '$id_user' ";
$result   = mysqli_query($conn,$cari);
if (mysqli_num_rows($result) > 0)
{
  while ($data = mysqli_fetch_array($result))
  {
    if(password_verify($pswlama, $data['password']))
    {
      $perintah = "UPDATE user SET password = '$pswbaru',
									nama = '$nama',	
									username = '$username',	
									no_rek	 = '$no_rek',
									bank	 = '$bank',	
									no_hp	 = '$no_hp'	
								WHERE id_user = '$id_user' ";
      if (mysqli_query($conn, $perintah)) 
      {
        echo "<script>alert('Ubah Password berhasil! Klik ok untuk melanjutkan');location.replace('home.php')</script>";
       
      } 
        else 
        {
          echo "Error updating record: " . mysqli_error($conn);
        }
    }
      else
      {
        echo "<script>alert('Password lama salah, input dengan benar password lama Anda!');history.go(-1)</script>";
      }
  }
}
  else
  {
    echo "<script>alert('Akun tidak ditemukan');history.go(-1)</script>";
  }
?>