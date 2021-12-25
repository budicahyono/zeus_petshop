<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session

include '../fungsi/tgl_indo.php';         // Panggil fungsi merubah tanggal menjadi format seperti 2 Mei 2015



	  
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Customer Baru | Administrator</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../images/logo.png" />
   <?php include "css.php" ?>
    <!-- Data Tables -->
    <link href="template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
   
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include 'header.php'; ?>

      <div class="content-wrapper">
        <section class="content-header">
          <h1>Daftar Customer</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="customer.php">Daftar Customer</a></li>
          </ol>
        </section>

        <section class="content">
			<div class="box">
			  <div class="box-body table-responsive padding">
				<table id="example1" class="table table-bordered table-striped">
				  <thead>
					<tr>
					  <th style="text-align: center">ID</th>
					  <th style="text-align: center">Nama Customer</th>
					  <th style="text-align: center">Email</th>
					  <th style="text-align: center">Username</th>
					  <th style="text-align: center">Alamat</th>
					  <th style="text-align: center">Status</th>
					  <th style="text-align: center">Aksi</th>
					</tr>
				  </thead>
				  <tbody>

				  <?php
					$sql = "SELECT * FROM customer";
					$result = mysqli_query($conn, $sql);
				  if (mysqli_num_rows($result) > 0)
				  {
					while ($row = mysqli_fetch_array($result))
					{
						
						
					  ?>
					  <tr>
						<td valign='top' align='center'><?php echo $row['id_customer'] ?></td>
						<td style='text-align: center'><?php echo $row['nama'] ?></td>
						<td style='text-align: center'><?php echo $row['email'] ?></td>
						<td style='text-align: center'><?php echo $row['username'] ?><br>
														<span style="color:#fff"><?php echo $row['password'] ?></span></td>
						<td style='text-align: center'><?php echo $row['alamat'] ?></td>
						<td style='text-align: center'>
						<?php if  ($row['status'] == 1) { ?>
						<label  class='label label-success'>Aktif</label>
						<?php } else if  ($row['status'] == 0) { ?>
						<label  class='label label-danger'>Non Aktif</label>
						<?php } ?>
						</td>
						<td style='text-align: center'>
						  <a href='customer_detail.php?id=<?php echo $row['id_customer'] ?>' class='btn btn-primary'>Selengkapnya</a> 
						   
							<a class="btn btn-md btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus customer ini?')" href="customer_hapus.php?id=<?php echo $row['id_customer'] ?>">
						  <span class="glyphicon glyphicon-trash" ></span>
						  </a>						   
						</td>
					  </tr>
					  <?php
					}
				  } else {echo "Belum ada data";}
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