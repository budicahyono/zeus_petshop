<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session

include '../fungsi/tgl_indo.php';          // Panggil data setting

$notransaksi  = $_GET['notransaksi'];


	
// Proses delete
		
$query_del 	= "SELECT * FROM transaksi_detail WHERE notransaksi='$notransaksi'";
	$sql_del 	= mysqli_query($conn, $query_del);
while($row = mysqli_fetch_array($sql_del))
{
	$id_produk = $row['id_produk'];
	$jumlah	   = $row['jumlah'];
	
	$cari_barang  = "SELECT * FROM produk WHERE id_produk = '$id_produk' ";
	$hasil_barang = mysqli_query($conn, $cari_barang);
	$data_barang  = mysqli_fetch_array($hasil_barang);

	$stok         = $data_barang['stok'];
	
	$stok_tambah = $stok + $jumlah;
		$query_produk = mysqli_query($conn, "update produk SET stok = '$stok_tambah'
													WHERE id_produk = '$id_produk'");
		
		$query2 = "DELETE FROM transaksi_detail	WHERE notransaksi = '$notransaksi'";
		$sql2 = mysqli_query ($conn, $query2); 
		
}		
		$cek_bayar 	= "SELECT * FROM bayar WHERE notransaksi='$notransaksi'";
		$sql_bayar 	= mysqli_query($conn, $cek_bayar);
		if(mysqli_num_rows($sql_bayar) > 0)
		{
		
			$query3 = "DELETE FROM bayar WHERE notransaksi = '$notransaksi'";
			$sql3 = mysqli_query ($conn, $query3); 
			$hasil 	= mysqli_fetch_array($sql3);
	
			$foto_struk		=$hasil['foto_struk'];
			$dir_foto_kos	= "../foto_struk/$foto_struk";
			unlink ($dir_foto_kos);
			$dir_foto_kos_resize	= "../foto_struk/resize_$foto_struk";
			unlink ($dir_foto_kos_resize);
		}	
		
		$query = "DELETE FROM transaksi	WHERE notransaksi = '$notransaksi'";
		$sql = mysqli_query ($conn, $query); 
		
		if ($sql) {
			$pesan = "Pesanan Dihapus!!";
			
		} else {
			$pesan = "Pesanan Gagal Dihapus";
		}



?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Hapus Pesanan Barang | Administrator  </title>
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
          <h1>Hapus Pesanan Barang</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a >Hapus Pesanan </a></li>
          </ol>
        </section>

        <section class="content">
			<div class="box">
			  <div class="box-body table-responsive padding">
				<div class="alert alert-success">
				<?php echo $pesan ?>
				</div>
				<a class='btn btn-success' href="pesanan.php" >Kembali</a>
			  </div>
			</div>
        </section>
      </div>

      <?php include "footer.php" ?>

    </div>
<?php include 'js.php'; ?>   
  </body>
</html>