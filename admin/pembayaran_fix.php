<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session

include '../fungsi/tgl_indo.php';          // Panggil data setting

$notransaksi  = $_GET['notransaksi'];

// Proses update
		$query = "UPDATE transaksi SET status = 3
							WHERE notransaksi = '$notransaksi'";
		$sql = mysqli_query ($conn, $query); 
  
  
		
		if ($sql) {
			$pesan = "Konfirmasi Diterima!!";
			
		} else {
			$pesan = "Konfirmasi Gagal Diterima";
		}



?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Terima Konfirmasi Pembayaran <?php echo " | "; echo $namatoko ?> </title>
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
          <h1>Terima Konfirmasi Pembayaran</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a >Terima Pembayaran</a></li>
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