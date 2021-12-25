<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session
include '../fungsi/judul_seo.php';        // Panggil fungsi judul_seo untuk merubah teks dalam format tanpa spasi dan simbol

if(isset($_POST['submit']))
{
  $nama_produk    = mysqli_real_escape_string($conn, $_POST['nama_produk']);
  $judul_seo      = judul_seo($nama_produk);
  $seo_deskripsi  = mysqli_real_escape_string($conn, $_POST['seo_deskripsi']);
  $seo_keywords   = mysqli_real_escape_string($conn, $_POST['seo_keywords']);
  $deskripsi      = mysqli_real_escape_string($conn, $_POST['deskripsi']);
  $harga          = mysqli_real_escape_string($conn, $_POST['harga']);
  $stok           = mysqli_real_escape_string($conn, $_POST['stok']);
  $berat           = mysqli_real_escape_string($conn, $_POST['berat']);
  $kat            = mysqli_real_escape_string($conn, $_POST['cmbkat']);

  $cekdata = "SELECT nama_produk FROM produk WHERE nama_produk = '$nama_produk' ";
  $ada     = mysqli_query($conn, $cekdata);
  if(mysqli_num_rows($ada) > 0)
  { 
    echo "<script>alert('ERROR: Judul telah terdaftar, silahkan pakai Judul lain!');history.go(-1)</script>";
  }
    else
    {
      $allowed_ext  = array('jpg', 'jpeg', 'png', 'gif');
      $file_name    = $_FILES['img']['name']; // file yg di upload
	  $nama_file    =  $file_name; // nama file
     $tmp			  = explode('.', $nama_file);
  $file_ext       = strtolower(end($tmp));
      $file_size    = $_FILES['img']['size'];
      $file_tmp     = $_FILES['img']['tmp_name'];
      $lokasi       = '../images/produk/'.$judul_seo.'.'.$file_ext;
      $img          = $judul_seo.'.'.$file_ext;

      if(in_array($file_ext, $allowed_ext) === true)
      {
		  
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
        // Proses insert data dari form ke db
        $sql = "INSERT INTO produk (nama_produk,
                                    judul_seo,
                                    seo_deskripsi,
                                    seo_keywords,
                                    deskripsi,
                                    kat,
                                    harga,
                                    stok,
                                    berat,
                                    uploader,
                                    jam_upload,
                                    tgl_upload,
                                    img)
                            VALUES ('$nama_produk',
                                    '$judul_seo',
                                    '$seo_deskripsi',
                                    '$seo_keywords',
                                    '$deskripsi',
                                    '$kat',
                                    '$harga',
                                    '$stok',
                                    '$berat',
                                    '$sesen_username',
                                    now(),
                                    now(),
                                    '$img')";
        if(mysqli_query($conn, $sql)) 
        {
          echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('produk_list.php')</script>";
        } 
          else 
          {
            echo "Error updating record: " . mysqli_error($conn);
          }
      } 
        else
        {
          echo "<script>alert('Jenis file tidak sesuai!');history.go(-1)</script>";
        }
    }
}
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
  }
?>