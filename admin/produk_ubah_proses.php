<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/judul_seo.php';        // Panggil fungsi mengubah teks menjadi tanpa spasi dan simbol

if(isset($_POST['submit']))
{
  $id_produk      = mysqli_real_escape_string($conn, $_POST['id_produk']);
  $nama_produk    = mysqli_real_escape_string($conn, $_POST['nama_produk']);
  $judul_seo      = judul_seo($nama_produk);
  $seo_deskripsi  = mysqli_real_escape_string($conn, $_POST['seo_deskripsi']);
  $seo_keywords   = mysqli_real_escape_string($conn, $_POST['seo_keywords']);
  $deskripsi      = mysqli_real_escape_string($conn, $_POST['deskripsi']);
  $harga          = mysqli_real_escape_string($conn, $_POST['harga']);
  $stok           = mysqli_real_escape_string($conn, $_POST['stok']);
  $berat           = mysqli_real_escape_string($conn, $_POST['berat']);
  $kat            = mysqli_real_escape_string($conn, $_POST['cmbkat']);

  $allowed_ext    = array('jpg', 'jpeg', 'png', 'gif');
  $file_name      = $_FILES['img']['name']; // file yg di upload
  $nama_file      = $_POST['img_hidden']; // nama file
  $tmp			  = explode('.', $nama_file);
  $file_ext       = strtolower(end($tmp));
  $file_size      = $_FILES['img']['size'];
  $file_tmp       = $_FILES['img']['tmp_name'];
  $lokasi         = "../images/produk/$judul_seo.$file_ext";
  $img            = $judul_seo.'.'.$file_ext;

  if(!empty($file_tmp))
  {
    if(in_array($file_ext, $allowed_ext) === true)
    {
      //Hapus photo yang lama jika ada
      $del  = "SELECT img FROM produk WHERE id_produk = '$id_produk' ";
      $res  = mysqli_query($conn, $del);
      $d    = mysqli_fetch_object($res);
      if(strlen($d->img)>3)
      if(file_exists($d->img))
      {
        // Memutuskan koneksi file yang lama
        unlink($d->img);
      }
	  
	   $width_size = 100; //ukuran width_size struk
	   $width_size2 = 350; //ukuran width_size struk
  $dir_upload = "../images/produk/";
   $filesave = $dir_upload . $img;
  
 move_uploaded_file($file_tmp, $lokasi);

// menentukan nama image setelah dibuat
$resize_image = $dir_upload . "100px_" . $judul_seo. ".".$file_ext;		
$resize_image2 = $dir_upload . "350px_" . $judul_seo. ".".$file_ext;		
 
 // mendapatkan ukuran width dan height dari image
list( $width, $height ) = getimagesize($filesave);

// mendapatkan nilai pembagi supaya ukuran skala image yang dihasilkan sesuai dengan aslinya
$bagi = $width / $width_size;
$bagi2 = $width / $width_size2;

// menentukan width yang baru
$newwidth = $width / $bagi;
$newwidth2 = $width / $bagi2;

// menentukan height yang baru
$newheight = $height / $bagi;
$newheight2 = $height / $bagi2;

// fungsi untuk membuat image yang baru
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imagecreatefromjpeg($filesave);
$thumb2 = imagecreatetruecolor($newwidth2, $newheight2);
$source2 = imagecreatefromjpeg($filesave);


// men-resize image yang baru
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
imagecopyresized($thumb2, $source2, 0, 0, 0, 0, $newwidth2, $newheight2, $width, $height);

// menyimpan image yang baru
imagejpeg($thumb, $resize_image);
imagejpeg($thumb2, $resize_image2);

imagedestroy($thumb);
imagedestroy($thumb2);
imagedestroy($source);
imagedestroy($source2);
	  
      
      // Update photo dengan yang baru
      $update = "UPDATE produk SET img = '$img' WHERE id_produk = '$id_produk' ";
      $upd = mysqli_query($conn, $update);
    } 
      else
      {
        echo "<script>alert('Format file tidak sesuai!');history.go(-1)</script>";
      } 
  }

  $sql = "UPDATE produk SET id_produk     = '$id_produk',
                            nama_produk   = '$nama_produk',
                            judul_seo     = '$judul_seo',
                            seo_deskripsi = '$seo_deskripsi',
                            seo_keywords  = '$seo_keywords',
                            deskripsi     = '$deskripsi',
                            harga         = '$harga',
                            stok          = '$stok',
                            berat         = '$berat',
                            kat           = '$kat',
                            updater       = '$sesen_username',
                            jam_update    = now(),
                            tgl_update    = now() 
                      WHERE id_produk     = '$id_produk' ";
                            
  if(mysqli_query($conn, $sql)) 
  {
    echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('produk_list.php')</script>";
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