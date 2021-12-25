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
    <title>Chatting | Administrator</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../images/logo.png" />
	<?php include 'css.php'; ?>
     <link href="template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include 'header.php'; ?>

      <div class="content-wrapper">
        <section class="content-header">
          <h1>Daftar Chatting</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="chatting.php">Daftar Chatting</a></li>
          </ol>
        </section>

        <section class="content">
			<div class="box">
			  <div class="box-body table-responsive padding">
				<table id="example1" class="table table-bordered table-striped">
				  <thead>
					<tr>
					  <th style="text-align: center">NO</th>
					  <th style="text-align: center">Username</th>
					  <th style="text-align: center">Chat ID</th>
					  <th style="text-align: center">Status</th>
					  <th style="text-align: center">Aksi</th>
					</tr>
				  </thead>
				  <tbody>

				  <?php
				  $no=1;
					$sql = "SELECT * FROM chatting  order by id desc";
					$result = mysqli_query($conn, $sql);
				  if (mysqli_num_rows($result) > 0)
				  {
					while ($row = mysqli_fetch_array($result))
					{
						
						
					  ?>
					  <tr>
						<td valign='top' align='center'><?php echo $no ?></td>
						<td style='text-align: center'><?php echo $row['username'] ?></td>
						<td style='text-align: center'><?php echo $row['id_chatting'] ?></td>
						<td style='text-align: center'>
						<?php if  ($row['status_chat'] == 1) { ?>
						<label  class='label label-success'>Aktif</label>
						<?php } else if  ($row['status_chat'] == 0) { ?>
						<label  class='label label-danger'>Non Aktif</label>
						<?php } ?>
						</td>
						<td style='text-align: center'>
						  <a href='chatting_detail.php?id=<?php echo $row['id_chatting'] ?>' class='btn btn-primary'>Selengkapnya</a> 
						   
							<a class="btn btn-md btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus chatting ini?')" href="chat_id_hapus.php?id=<?php echo $row['id_chatting'] ?>">
						  <span class="glyphicon glyphicon-trash" ></span>
						  </a>						   
						</td>
					  </tr>
					  <?php
					$no++;}
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