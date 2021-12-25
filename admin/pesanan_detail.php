<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session

include '../fungsi/tgl_indo.php';          // Panggil data setting

$notransaksi  = $_GET['notransaksi'];
$faktur  = $_GET['notransaksi'];

$sql_pesanan  = mysqli_query($conn,"SELECT c.nama, c.username, t.notransaksi, t.tgl_checkout, c.alamat, c.kota, c.provinsi, c.kopos, t.status AS status_trx, o.origin, o.destination, o.weight, o.service FROM transaksi t, transaksi_detail td, customer c, ongkir o WHERE t.notransaksi=td.notransaksi AND  t.username = c.username AND o.notransaksi = t.notransaksi  AND t.status >= 1 AND t.notransaksi =$notransaksi");

$hasil        = mysqli_fetch_array($sql_pesanan);

$nama         = $hasil['nama'];
$username     = $hasil['username'];
$sesen_username     = $hasil['username'];
$notransaksi  = $hasil['notransaksi'];
$tgl_checkout = tgl_indo($hasil['tgl_checkout']);
$alamat       = $hasil['alamat'];

$kota       = $hasil['kota'];
$provinsi       = $hasil['provinsi'];
$kopos       = $hasil['kopos'];
$status       = $hasil['status_trx'];

$origin = $hasil['origin'];
$destination = $hasil['destination'];
$weight = $hasil['weight'];
$service = $hasil['service'];
 
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
//echo $response;
	
}
$data = json_decode($response, true); 

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Invoice #<?php echo $notransaksi; ?> | Administrator </title>
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
          <h1>NO. INVOICE #<?php echo $notransaksi;  ?> </h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Pesanan</li>
            <li class="active"><a href="product_list.php">No. Invoice #<?php echo $notransaksi ?></a></li>
          </ol>
        </section>

        <section class="content">
          <div class="pad margin no-print">
            <div class="callout callout-info" style="margin-bottom: 0!important;">                        
              <h4><i class="fa fa-info"></i> Note:</h4>
              Halaman ini bisa langsung diprint dengan menekan tombol (ctrl + p) pada keyboard
            </div>
          </div>
			   
          <!-- Main content -->
          <section class="invoice">
            <!-- title row -->
            <div class="row">
              <div class="col-xs-12">
                <h2 class="page-header">
                  <i class="fa fa-globe"></i> Zeus Petshop
                </h2>
              </div><!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                Dari
                <address>
                  <strong>Zeus Petshop</strong><br>
                   Alamat: Jalan Merdeka, Manokwari, Papua Barat
                </address>
              </div><!-- /.col -->
              <div class="col-sm-4 invoice-col">
			 
               Kepada
                <address>
                  <strong><?php echo $nama ?></strong><br>
                  <?php 
				  
				  echo $alamat; echo', '; 
                        echo $data['rajaongkir']['destination_details']['city_name']; echo', '; 
                        echo $data['rajaongkir']['destination_details']['province']; echo', '; 
                        echo $data['rajaongkir']['destination_details']['postal_code'];
                  ?>
                </address>
				
              </div><!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>No.Invoice #<?php echo $notransaksi ?></b><br/>
                <b>Tanggal Pemesanan: <?php echo $tgl_checkout ?></b><br/>
              </div><!-- /.col -->
            </div><!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Barang</th>
                      <th>Berat</th>
                      <th>Jumlah Berat</th>
                      <th>Harga</th>
                      <th>Qty</th>
                      <th>Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				  $no = 1;
					$hasil_invoice = 	mysqli_query($conn,"SELECT transaksi.notransaksi,transaksi.username,transaksi.status,
                	produk.id_produk,produk.nama_produk,produk.judul_seo,
	                transaksi_detail.berat,transaksi_detail.harga,transaksi_detail.jumlah,
	                transaksi_detail.jumlah_berat,transaksi_detail.subtotal
	                FROM transaksi_detail
	                LEFT JOIN transaksi ON transaksi.notransaksi = transaksi_detail.notransaksi
	                INNER JOIN produk ON produk.id_produk = transaksi_detail.id_produk
	                WHERE transaksi.notransaksi = '$notransaksi'  
	                AND transaksi.status >= 1 ");
					 while ($row = mysqli_fetch_array($hasil_invoice))
					{
					?>
                     <tr>
                        <td align='center'><?php echo $no ?></td>
                        <td align='left'><?php echo $row['nama_produk'] ?></td>
                        <td style='text-align: center;width:100px'><?php echo number_format($row['berat']) ?> gram</td>
                        <td style='text-align: center'><?php echo number_format($row['jumlah_berat']) ?> gram</td>
                        <td style='text-align: center;width:150px'>Rp <?php echo number_format($row['harga']) ?></td>
                        <td style='text-align: center'><?php echo $row['jumlah'] ?></td>
                        <td style='text-align: left'>Rp <?php echo number_format($row['subtotal']) ?></td>
                      </tr>
					<?php 
					$no++;
					} ?> 
                  </tbody>
				   <?php 
			include '../keranjang/keranjang_total.php';
			include '../keranjang/keranjang_total2.php';
		  ?>
		  
        <tr>
          <th style="text-align: center; background: #ddd"> </th>
          <th style="text-align: center; background: #ddd"></th>
          <th style="text-align: center; background: #ddd"></th>
          <th style="text-align: center; background: #ddd">  <?php echo number_format($jumlah_berat_all) ?> gram</th>
          <th style="text-align: center; background: #ddd"></th>
          <th style="text-align: center; background: #ddd"></th>
          <th style="text-align: left; background: #ddd">Rp <?php echo number_format($subtotal_all) ?>,- </th>
        </tr>
                </table>
              </div><!-- /.col -->
            </div><!-- /.row -->

            <div class="row">
              <div class="col-xs-12">
                <div class="table-responsive">
			
		<?php 
	if 	($status > 1) {
	 for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
	 ?>
	 <div style=" padding:10px 0 10px 10px;font-weight:bold; border-bottom: 2px solid #ddd; border-top: 2px solid #ddd; display: block">JASA PENGIRIMAN : <?php echo strtoupper($data['rajaongkir']['results'][$i]['name']); ?></div><br>
                  <table  class="table table-striped " style=" border-bottom: 2px solid #ddd;" align="left">
			<thead>
			 <tr>
				 <td style="width:20px; text-align: center; background: #ddd; font-weight: bold">No.</td>
				 <td style="width:100px; text-align: center; background: #ddd;  font-weight: bold">Service</td>
				 <td style="width:200px; text-align: center; background: #ddd; font-weight: bold">Deskripsi</td>
				 <td style="width:150px; text-align: center; background: #ddd;  font-weight: bold">Tarif</td>
				 <td style="width:120px; text-align: center; background: #ddd;  font-weight: bold">Lama Pengiriman</td>
			 </tr>
			</thead>
			  <?php
			   $no= 1;
			   for ($j=0; $j < count($data['rajaongkir']['results'][$i]['costs']); $j++) {
					if ($data['rajaongkir']['results'][$i]['costs'][$j]['service'] == $service)
					{			

			   ?>
			<tbody>   
				<tr>
				 <td style=" line-height: 20px; padding: 4px 5px; text-align: center;"><?php echo $no;?></td>
				<td style=" line-height: 20px; padding: 4px 5px;" align="right">
				 <?php echo strtoupper($data['rajaongkir']['results'][$i]['costs'][$j]['service'] ); ?></td>
				 <td style=" line-height: 20px; padding: 4px 5px;" align="right"><?php echo strtoupper($data['rajaongkir']['results'][$i]['costs'][$j]['description'] ); ?></td>
				 <td style=" line-height: 20px; padding: 4px 5px;" align="right">
					 <?php
				  
					  echo $harga = "Rp ".number_format($data['rajaongkir']['results'][$i]['costs'][$j]['cost'][0]['value']);
					  $harga_ongkir =
					  $data['rajaongkir']['results'][$i]['costs'][$j]['cost'][0]['value']
				
				   ?>	
				 </td>
				 <td style=" line-height: 20px; padding: 4px 5px;" align="right">
					 <?php
				   
					   echo $etd = $data['rajaongkir']['results'][$i]['costs'][$j]['cost'][0]['etd']." hari";
					  
				   ?>	
				 </td>
				 
				 </tr>
			</tbody>  	 
			   <?php 
					}	
			   } ?> 
			 
			
		 </table>
	<?php }} else {
		$harga_ongkir = 0;
	}
	
	$grand_total = $harga_ongkir + $subtotal_all ?>
		<p>Total biaya invoice ini adalah sebesar <h1 style="color:#d9534f">Rp <?php echo number_format($grand_total, 0, ',', '.').',-'; ?></h1></p>
                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </section><!-- /.content -->
				
        </section>
      </div>

      <div class=" no-print">
        <?php include "footer.php" ?>
      </div>

    </div>
<?php include 'js.php'; ?>   
  </body>
</html>