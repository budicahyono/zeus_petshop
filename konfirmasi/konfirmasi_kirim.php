<?php
// Skrip ini merupakan skrip untuk mengirim email dari form konfirmasi pembayaran yang dikirimkan oleh user
include '../config.php';

// Jika tombol submit ditekan maka akan mulai proses pengiriman konfirmasi pembayaran ke email ADMIN
if(isset($_POST['submit']))
{
  $no_invoice     = mysqli_real_escape_string($conn,$_POST['no_invoice']);
  $nama_pengirim  = mysqli_real_escape_string($conn,$_POST['nama_pengirim']);
  $email          = mysqli_real_escape_string($conn,$_POST['email']);
  $jml_transfer   = mysqli_real_escape_string($conn,$_POST['jml_transfer']);
  $tgl_transfer   = mysqli_real_escape_string($conn,$_POST['tgl_transfer']);
  
  $width_size = 100; //ukuran width_size struk
  $dir_upload = "../foto_struk/";
  $foto_struk = mysqli_real_escape_string($conn,$_FILES['foto_struk']['name']);
  $tmp			  = explode('.', $foto_struk);
  $file_ext       = strtolower(end($tmp));
  $foto_struk_baru            = 'trx_struk_'.$no_invoice.'.'.$file_ext;
  $filesave = $dir_upload . $foto_struk_baru;
  if (is_uploaded_file($_FILES['foto_struk']['tmp_name'])) {
			$cek = move_uploaded_file ($_FILES['foto_struk']['tmp_name'],
			$dir_upload.$foto_struk_baru);
		}




		
// menentukan nama image setelah dibuat
$resize_image = $dir_upload . "resize_trx_struk_" . $no_invoice. ".".$file_ext;		
 
 // mendapatkan ukuran width dan height dari image
list( $width, $height ) = getimagesize($filesave);
 $size = getimagesize($filesave);


// mendapatkan nilai pembagi supaya ukuran skala image yang dihasilkan sesuai dengan aslinya
$bagi = $width / $width_size;

// menentukan width yang baru
$newwidth = $width / $bagi;

// menentukan height yang baru
$newheight = $height / $bagi;

// fungsi untuk membuat image yang baru
$thumb = imagecreatetruecolor($newwidth, $newheight);
 switch($size["mime"]){
        case "image/jpeg":
            $source = imagecreatefromjpeg($filesave); //jpeg file
            break;
        case "image/gif":
            $source = imagecreatefromgif($filesave); //gif file
            break;
        case "image/png":
            $source = imagecreatefrompng($filesave); //png file
            break;
        default: 
            $source=false;
            break;
    }

// men-resize image yang baru
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

// menyimpan image yang baru
imagejpeg($thumb, $resize_image);

imagedestroy($thumb);
imagedestroy($source);
 
  
		
	// Proses update
		$query = "UPDATE transaksi SET status = 2
							WHERE notransaksi = '$no_invoice'";
		$sql = mysqli_query ($conn, $query); 
  
  // insert ke tabel bayar
  $query_bayar 	= "INSERT bayar SET
							notransaksi 		    = '$no_invoice',
							pengirim	 		    = '$nama_pengirim',
							email 		        	= '$email',
							jml_transfer 	        = '$jml_transfer',
							tgl_transfer 	        = '$tgl_transfer',
							foto_struk		 	    = '$foto_struk_baru'";
		$sql_bayar = mysqli_query ($conn, $query_bayar); 
		
		

		
		if ($sql_bayar) {
			echo "<script>alert('Konfirmasi Pembayaran Berhasil disimpan!! Tunggu kurang dari 30 menit untuk kami memprosesnya!!'); location.replace('../konfirmasi.html')</script>";
			
		} else {
			echo "<script>alert('Konfirmasi Pembayaran Gagal disimpan, cobalah sekali lagi!');history.go(-1)</script>";
		}
  
}
  // Peringatan apabila user tidak melalui proses yang seharusnya atau tembak langsung
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombolnya!');history.go(-1)</script>";
  }
?>