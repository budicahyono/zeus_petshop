<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session

include '../fungsi/tgl_indo.php';          // Panggil data setting

$notransaksi  = $_GET['notransaksi'];


$query_del 	= "SELECT * FROM bayar WHERE notransaksi='$notransaksi'";
	$sql_del 	= mysqli_query($conn, $query_del);
	$hasil 	= mysqli_fetch_array($sql_del);
	
	$foto_struk		=$hasil['foto_struk'];
	$dir_foto_kos	= "../foto_struk/$foto_struk";
	unlink ($dir_foto_kos);
	$dir_foto_kos_resize	= "../foto_struk/resize_$foto_struk";
	unlink ($dir_foto_kos_resize);
	
// Proses update
		$query = "DELETE FROM bayar	WHERE notransaksi = '$notransaksi'";
		$sql = mysqli_query ($conn, $query); 
  
		$query1 = "UPDATE transaksi SET status = 1
							WHERE notransaksi = '$notransaksi'";
		$sql1 = mysqli_query ($conn, $query1); 
		
		if ($sql) {
			$pesan = "Konfirmasi Dihapus!!";
			
		} else {
			$pesan = "Konfirmasi Gagal Dihapus";
		}



?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Hapus Konfirmasi Pembayaran <?php echo " | "; echo $namatoko ?> </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../images/logo.png" />
    <!-- JS -->
   <?php include "css.php" ?>
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include 'header.php'; ?>

      <div class="content-wrapper">
        <section class="content-header">
          <h1>Hapus Konfirmasi Pembayaran</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a >Hapus Pembayaran</a></li>
          </ol>
        </section>

        <section class="content">
			<div class="box">
			  <div class="box-body table-responsive padding">
				<div class="alert alert-success">
				<?php echo $pesan ?>
				</div>
				<a class='btn btn-success' href="pembayaran.php" >Kembali</a>
			  </div>
			</div>
        </section>
      </div>

      <?php include "footer.php" ?>

    </div>
<?php include 'js.php'; ?>   
  </body>
</html>