<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session

include '../fungsi/tgl_indo.php';          // Panggil data setting

$id  = $_GET['id'];
$user  = $_GET['user'];
 $sql = "UPDATE customer SET status      = '1' 
                      WHERE id_customer       = '$id' ";
                            
  $cek = mysqli_query($conn, $sql);



?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ID CUSTOMER #<?php echo $id; ?> | Administrator</title>
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
          <h1>ID. CUSTOMER #<?php echo $id;  ?> </h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Customer</li>
            <li class="active"><a href="customer_detail.php?id=<?php echo $id ?>"><?php echo $user ?></a></li>
          </ol>
        </section>

        <section class="content">
          
			   
          <!-- Main content -->
          <section class="invoice">
            <!-- title row -->
            <div class="row">
              <div class="col-xs-12">
                <h2 class="page-header">
                  <i class="fa fa-list-alt"></i> Detail Customer
                </h2>
              </div><!-- /.col -->
            </div>
            <!-- info row -->
            
			
            <!-- Table row -->
            <div class="row">
              <div class="col-xs-12 table-responsive">
			  <?php 
               if($cek) {
			  ?>			
			   <div class="alert alert-success">USER <?php echo $user ?> SUDAH DIAKTIFKAN!!</div>
				
				<a href='customer.php' class='btn btn-info' >
					<span class='glyphicon glyphicon-arrow-left' aria-hidden='true'></span>&nbsp;Kembali ke customer		
			      </a>
			   <?php } ?> 
              </div><!-- /.col -->
            </div><!-- /.row -->

          
	 
                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </section><!-- /.content -->
				
        </section>
      </div>

      <div class="row no-print">
        <?php include "footer.php" ?>
      </div>

    </div>
 <?php include 'js.php'; ?>
  </body>
</html>