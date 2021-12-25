<?php session_start();                    // Memulai session
include 'config.php';                     // Panggil koneksi ke database
include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public
include 'fungsi/tgl_indo.php';            // Panggil fungsi tanggal indonesia
//ZEUS PUNNYA

$sql_admin 		= mysqli_query($conn,"SELECT *  FROM user WHERE id_user = '1' ");
$hasil_admin 							= mysqli_fetch_array($sql_admin);


// isi API
$nama_admin 			= $hasil_admin['nama'];
$no_rek_admin 			= $hasil_admin['no_rek'];
$bank_admin 			= $hasil_admin['bank'];
$no_hp_admin 			= $hasil_admin['no_hp'];



$origin = $_POST['origin'];
$destination = $_POST['destination'];
$weight = $_POST['weight'];
 
$curl = curl_init();
 
curl_setopt_array($curl, array(
		CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=jne",
		CURLOPT_HTTPHEADER => array(
		"content-type: application/x-www-form-urlencoded",
		"key: 050eb79e0ce195656d97a083143baff5"
		),
	));
 
$response = curl_exec($curl);
$err = curl_error($curl);
 
curl_close($curl);
 
if ($err) {
	echo "cURL Error #:" . $err;
} else {
// echo $response;
	
}




?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title> Zeus Petshop</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Zeus Petshop"/>
    <meta name="keywords" content="Zeus Petshop"/>
    <meta name="author" content="Zeus Petshop"/>    
    <!-- CSS Bootstrap -->
    <link href="<?php echo $base_url ?>template/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>template/css/custom.css" rel="stylesheet">
    <!-- Favicon -->
    <link href="<?php echo $base_url ?>images/logo.png" rel="shortcut icon"/>
  </head>
  <body>
<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12 ">
          <h3 class="kotak"><span class="glyphicon glyphicon-shopping-cart kotak-icon"></span> Lihat Ongkos Kirim</h3>
        </div>
      </div>
	  
	  <div class="row text-center" style="width:900px;margin:auto">
<div class="col-sm-12 hero-feature">
        <div class="thumbnail">
		<div class="title">
		 <a class="disabled">
            <h4>Lihat Ongkos Kirim dengan berat <?php echo $weight ?> gram</h4>
		</a>	
		</div>	
	  
     
	  <?php 
	  $data = json_decode($response, true); 
	 for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
	 ?>
	 <h5 style="padding:10px;font-weight:bold">JASA PENGIRIMAN : <?php echo strtoupper($data['rajaongkir']['results'][$i]['name']); ?></h5>
	 <form method="post" id="form2" action="checkout.php">
		<input type="hidden" name="weight" value="<?php echo $weight ?>">
		<input type="hidden" name="origin" value="<?php echo $origin ?>">
		<input type="hidden" name="destination" value="<?php echo $destination ?>">
	 <table   class="table table-striped">
						 <tr>
							 <th>No.</th>
							 <th>Service</th>
							 <th>Deskripsi</th>
							 <th>Tarif</th>
							 <th>Lama Pengiriman</th>
							 <th>Pilih</th>
						 </tr>
						
						  <?php
						   for ($j=0; $j < count($data['rajaongkir']['results'][$i]['costs']); $j++) {
						   ?>	 
						    <tr>
							 <td><?php echo $j+1;?></td>
							<td align="right">
							 <?php echo strtoupper($service = $data['rajaongkir']['results'][$i]['costs'][$j]['service'] ); ?></td>
							 <td align="right"><?php echo strtoupper($data['rajaongkir']['results'][$i]['costs'][$j]['description'] ); ?></td>
							 <td align="right">
								 <?php
							  
								  echo $harga = "Rp ".number_format($data['rajaongkir']['results'][$i]['costs'][$j]['cost'][0]['value']);
								  
							
							   ?>	
							 </td>
							 <td align="right">
								 <?php
							   
								   echo $etd = $data['rajaongkir']['results'][$i]['costs'][$j]['cost'][0]['etd']." hari";
								  
							   ?>	
							 </td>
							 <td >
								 <input required type="radio" name="service" value="<?php echo $service ?>" >&nbsp;&nbsp;<?php echo $service ?><br>
							 </td>
							 
							 </tr>
						   <?php } ?> 
						 
						
					 </table>
	 <?php } ?>
		<p style="margin-top:10px">&nbsp;</p>
		<button type='submit' class='btn btn-info' aria-label='Left Align' onclick="return confirm('Anda yakin ?')">
		<span class='glyphicon glyphicon-check' aria-hidden='true'></span> Selesaikan Transaksi		
		</button>
		</form>
            </div>
          </div>
        </div>

        
      </div>  
      
      <hr/>

      <?php include 'footer_nochat.php'; ?>

   
    
    <!-- Membuat fungsi input pada qty barang hanya boleh diisi dengan angka -->
    <script>
    function isNumberKey(evt)
    {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
      return true;
    }
    </script>
    <script src="<?php echo $base_url ?>template/js/jquery.js"></script>
    <script src="<?php echo $base_url ?>template/js/bootstrap.min.js"></script>
  </body>
</html>
