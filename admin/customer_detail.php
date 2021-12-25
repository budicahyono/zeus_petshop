<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session

include '../fungsi/tgl_indo.php';          // Panggil data setting

$id  = $_GET['id'];

$sql_customer  = mysqli_query($conn,"SELECT * FROM customer WHERE id_customer =$id");

$hasil        = mysqli_fetch_array($sql_customer);

$id_customer         = $hasil['id_customer'];
$nama         = $hasil['nama'];
$email     	= $hasil['email'];
$username     = $hasil['username'];
$alamat       = $hasil['alamat'];
$telepon       = $hasil['telepon'];
$kota       	= $hasil['kota'];
$kopos       	= $hasil['kopos'];
$provinsi       	= $hasil['provinsi'];
$status       	= $hasil['status'];

 
$curl = curl_init();
 
//Get Data Kabupaten / kota
	$curl = curl_init();	
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://api.rajaongkir.com/starter/city?id=".$kota,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
	    "key: 050eb79e0ce195656d97a083143baff5"
	  ),
	));
	
	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ID CUSTOMER #<?php echo $id_customer;?> | Administrator </title>
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
          <h1>ID. CUSTOMER #<?php echo $id_customer;  ?> </h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Customer</li>
             <li class="active"><a href="customer_detail.php?id=<?php echo $id ?>"><?php echo $id ?></a></li>
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
           <?php 
			$data = json_decode($response, true);
			$city = $data['rajaongkir']['results']['city_name'];
			$prov = $data['rajaongkir']['results']['province'];
			$kopos = $data['rajaongkir']['results']['postal_code'];
			
			?>	
			
            <!-- Table row -->
            <div class="row">
              <div class="col-xs-12 table-responsive">
                <table class="table table-striped" style="font-size:20px">
                    <tr>
                      <th width="200px">Nama Customer</th>
                      <td><?php echo $nama ?></td>
					</tr>  
					 <tr>
                      <th>Email</th>
                      <td><?php echo $email ?></td>
					</tr> 
					<tr>
                      <th>Username</th>
                      <td><?php echo $username ?></td>
					</tr>  
					<tr>
                      <th>No. Telepon</th>
                      <td><?php echo $telepon ?></td>
					</tr>  
					 <tr>
                      <th>Alamat</th>
                      <td><?php echo $alamat ?>, Kota/Kabupaten <?php echo $city ?>, Provinsi <?php echo $prov ?>, Kode Pos <?php echo $kopos ?></td>
					</tr> 
					<tr>
                      <th>Status</th>
                       <td>
						<?php if  ($status == 1) { ?>
						<label  class='label label-success'>Aktif</label>
						<?php } else if  ($status  == 0) { ?>
						<label  class='label label-danger'>Non Aktif</label>
						<?php } ?>
						</td>
					</tr> 
                   
                
		  
        
                </table>
				<?php if ($status == 1) { ?>
				<a href='customer.php' class='btn btn-info' >
					<span class='glyphicon glyphicon-arrow-left' aria-hidden='true'></span>&nbsp;Kembali ke customer		
			      </a>
				<?php } else if  ($status  == 0) { ?>
				<a href='aktif_customer.php?id=<?php echo $id_customer ?>&user=<?php echo $username ?>'>
			      	<button name='hapus' type='button' class='btn btn-success' aria-label='Left Align' title='Aktifkan' OnClick="return confirm('Apakah Anda yakin Aktifkan User ini?')">
							  <span class='glyphicon glyphicon-check' aria-hidden='true'></span>&nbsp;Aktifkan User
							</button>
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