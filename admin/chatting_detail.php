<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session

include '../fungsi/tgl_indo.php';         // Panggil fungsi merubah tanggal menjadi format seperti 2 Mei 2015

$id  = $_GET['id'];

$sql_customer  = mysqli_query($conn,"SELECT * FROM customer WHERE id_customer =$id");

$hasil        = mysqli_fetch_array($sql_customer);



	  
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Detail Chatting ID. #<?=$id?> | Administrator</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../images/logo.png" />
   <?php include 'css.php'; ?>
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include 'header.php'; ?>

      <div class="content-wrapper">
        <section class="content-header">
          <h1>Detail Chatting ID. #<?=$id?></h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
			<li>Detail Chatting</li>
            <li class="active"><a href="chatting_detail.php?id=<?=$id?>"><?=$id?></a></li>
          </ol>
        </section>

        <section class="content">
			<div class="box">
			  <div class="box-body clearfix">
			  <div class="form-group">
				 <a class="btn btn-md btn-success" href="chatting.php">
						  <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;&nbsp;Kembali
						  </a>
				 <a onclick="return confirm('Apakah Anda yakin ingin mengakhiri chat ini?')" class="btn btn-md btn-danger" href="chatting_akhir.php?id=<?=$id?>">
						  <span class="glyphicon  glyphicon-export"></span>&nbsp;&nbsp;Akhiri Chat
						  </a>		  
				</div>		
				<?php
				  $no=1;
					$sql = "SELECT * FROM chatting where id_chatting='$id' order by id_chatting desc";
					$result = mysqli_query($conn, $sql);
				  if (mysqli_num_rows($result) > 0)
				  {			
					$row = mysqli_fetch_array($result);
					if ($row['status_chat'] == 0) { $text = "disabled";} else { $text = ""; }
					  ?>	
				 <form class="form-group" onsubmit="return false" id="send">

						<div class="col-md-12">
						<div class="row">
						
							   
							  <div class="form-group"><label>Balas Chatting Ini</label>
								<textarea <?=$text?> style="height:70px" class="form-control" name="isi" id="isi" required ></textarea>
								<input class="form-control" name="level" id="level" type="hidden"  value="admin" required/>
								<input class="form-control" name="username" id="username"  type="hidden" value="<?php echo $sesen_username ?>"  >
								<input class="form-control" name="id_chatting" id="id_chatting"  type="hidden" value="<?php echo $id ?>"  >
							  </div>
							 
							<div class="box-footer">
							  <button id="submit" class="btn btn-success">Kirim</button>
							  <button type="reset" class="btn btn-danger">Reset</button>
							</div>
						</div>
						</div>

					</form>
					<div class="diskusi" id="get_chat">
								
							</div>					
				  <?php
						} else {
					?>
					<div class="col-md-12 dialog">
						<div class="alert alert-danger">Tidak ada Chatting!!</div>
					</div>
					<?php } ?>
			  </div>
			</div>
        </section>
      </div>

      <?php include "footer.php" ?>

    </div>
<?php include 'js.php'; ?>   
  </body>
</html>
</html>