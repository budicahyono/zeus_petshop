<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/base_url.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session

include '../fungsi/tgl_indo.php';         // Panggil fungsi merubah tanggal menjadi format seperti 2 Mei 2015



	  
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pembayaran | Administrator</title>
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
          <h1>Daftar Konfirmasi Pembayaran</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="pembayaran.php">Daftar Pembayaran</a></li>
          </ol>
        </section>

        <section class="content">
			<div class="box">
			  <div class="box-body table-responsive padding">
				<table class="table table-bordered table-striped">
				  <thead>
					<tr>
					  <th style="text-align: center">No.Invoice</th>
					  <th style="text-align: center">Nama Customer</th>
					  <th style="text-align: center">Email</th>
					  <th style="text-align: center">Jumlah Transfer</th>
					  <th style="text-align: center">Tanggal Transfer</th>
					  <th style="text-align: center">Foto Struk</th>
					  <th style="text-align: center">Aksi</th>
					</tr>
				  </thead>
				  <tbody id="example1" >

				  <?php
					$sql = "SELECT * FROM bayar b, transaksi t where b.notransaksi = t.notransaksi";
					$result = mysqli_query($conn, $sql);
				  if (mysqli_num_rows($result) > 0)
				  {
					while ($row = mysqli_fetch_array($result))
					{
						
						
					  ?>
					  <tr>
						<td valign='top' align='center'>
						
						<a data-toggle="tooltip" data-placement="top"  onclick="window.open('pesanan_detail.php?notransaksi=<?php echo $row['notransaksi'] ?>')" title="lihat detail" style="cursor:pointer"><button type='submit' class='btn btn-primary' >No. Invoice <?php echo $row['notransaksi'] ?> </button></a> 
						</td>
						<td style='text-align: center'><?php echo $row['pengirim'] ?></td>
						<td style='text-align: center'><?php echo $row['email'] ?></td>
						<td style='text-align: center'>Rp <?php echo number_format($row['jml_transfer']) ?>,-</td>
						<td style='text-align: center'><?php echo tgl_indo($row['tgl_transfer']) ?></td>
						<td style='text-align: center'>
							<a data-toggle="tooltip" data-placement="left" onclick="window.open('../foto_struk/<?php echo $row['foto_struk'] ?>')" style="cursor:pointer"title="Lihat Foto"><img style="width:100px;" class="img-responsive img-thumbnail" src="../foto_struk/resize_<?php echo $row['foto_struk'] ?>"/></a>
						</td>
						<td style='text-align: center'>
						
						<?php if ($row['status'] == 2) { ?>
						  
							
						  <a href='pembayaran_fix.php?notransaksi=<?php echo $row['notransaksi'] ?>'><button type='submit' class='btn btn-success' onclick="return confirm('Anda yakin ingin terima?')">Terima</button></a> 
						<?php } else { ?>
							<a style="cursor:not-allowed" class='btn btn-info'>Fixed</a> 
						<?php } ?>
						
						<p style="margin-bottom:10px"></p>	
						<a href='pembayaran_hapus.php?notransaksi=<?php echo $row['notransaksi'] ?>'><button type='submit' class='btn btn-danger' onclick="return confirm('Anda yakin ingin menghapusnya?')">Hapus</button></a>
						</td>
					  </tr>
					  <?php
					}
				  } else {?>
				  <tr ><td colspan="10" class="text-center">Belum ada data</td></tr>
				  <?php
				  }
				?>
				</tbody>
			  </table>
			  </div>
			</div>
        </section>
      </div>

      <?php include "footer.php" ?>

    </div>
<?php include 'js.php'; ?>   
  </body>
</html>