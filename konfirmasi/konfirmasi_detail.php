<?php 




if (!isset($_SESSION['username'])) {
	
	echo "<script>alert('Anda Harus Login untuk Konfirmasi Pembayaran!! '); location.replace('register.html')</script>";
	
} 

$notransaksi  = $_GET['id'];
$faktur  = $_GET['id'];



$sql_pesanan  = mysqli_query($conn,"SELECT nama, c.username, email, t.notransaksi, tgl_checkout, alamat, kota, provinsi, kopos, t.status AS status_trx, c.status AS status_c, o.service, o.origin, o.destination, o.weight  FROM transaksi t, transaksi_detail td, customer c, ongkir o  WHERE t.notransaksi=td.notransaksi AND  t.username = c.username  AND o.notransaksi = t.notransaksi AND t.status >= 1 AND t.notransaksi =$notransaksi");

$hasil        = mysqli_fetch_array($sql_pesanan);

$nama         = $hasil['nama'];
$username     = $hasil['username'];
$email     = $hasil['email'];
$notransaksi  = $hasil['notransaksi'];
$tgl_checkout = tgl_indo($hasil['tgl_checkout']);
$alamat       = $hasil['alamat'];
$kota       = $hasil['kota'];
$provinsi       = $hasil['provinsi'];
$kopos       = $hasil['kopos'];
$status_trx       = $hasil['status_trx'];


$origin = $hasil['origin'];
$destination = $hasil['destination'];
$weight = $hasil['weight'];
$service       = $hasil['service'];
 
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

 include 'navbar.php'; ?>

	<div class="container-fluid" style="margin-bottom:100px">
      
      <div class="row">
        <div class="col-lg-12 ">
          <h3 class="kotak"><span class="glyphicon glyphicon-th-list kotak-icon"></span> Detail Konfirmasi</h3>
        </div>
      </div>
	  
	  <div class="row" >
<div class="col-xs-12 hero-feature" >
        <div class="thumbnail clearfix">
		<div class="title">
		 <a class="disabled text-center" >
            <h4>Konfirmasi Pembayaran No. Invoice - #<?php echo $notransaksi ?> 
			  <?php if  ($status_trx == 4) { ?>
						<label  class='label label-success'>Dikirim </label>
						<?php } else if  ($status_trx == 3) { ?>
						<label  class='label label-Info'>Lunas</label>
						<?php } else if  ($status_trx == 2) { ?>
						<label  class='label label-warning'>Diproses</label>
						<?php } else if  ($status_trx == 1) { ?>
						<label  class='label label-danger'>Belum Bayar</label>
						<?php } ?>
						
			  </h4>
		</a>	
		</div>
		<div class="col-xs-12" style="margin-bottom:10px">
		  <div class="pull-left" >
			   <a href='../konfirmasi.html' type='submit' class='btn btn-warning'>Kembali</a> 
				
			   </div>
			   
		</div>	   
            <div class="invoice-info" style="margin-top:50px">
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
				   $data = json_decode($response, true); 
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
            <div class="">
              <div class="col-xs-12 table-responsive">
                <table id="example1" class="table table-striped">
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
                        <td style='text-align: center;width:100px'><?php echo number_format($row['berat'])  ?> gram</td>
                        <td style='text-align: center'><?php echo number_format($row['jumlah_berat'])  ?> gram</td>
                        <td style='text-align: center;'>Rp <?php echo number_format($row['harga']) ?></td>
                        <td style='text-align: center'><?php echo $row['jumlah'] ?></td>
                        <td style='text-align: left'>Rp <?php echo number_format($row['subtotal']) ?></td>
                      </tr>
					<?php 
					$no++;
					} ?> 
                  </tbody>
				   <?php 
		
			include 'keranjang/keranjang_total.php';
			include 'keranjang/keranjang_total2.php';
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
				
				
				
				
				 <table id="table-mini" class="table table-bordered">
                  
                   
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
					  <th rowspan="10">No.<?php echo $no ?></th>
                      <th>Nama Barang</th>
					   <td align='left'><?php echo $row['nama_produk'] ?></td>
                      </tr>
					  
					  <tr>
					  <th>Berat</th>
					   <td style='text-align: center;width:100px'><?php echo number_format($row['berat'])  ?> gram</td>
                      </tr>
					  
					  <tr>
					  <th>Jumlah Berat</th>
					   <td style='text-align: center'><?php echo number_format($row['jumlah_berat'])  ?> gram</td>
                      </tr>
					  
					  <tr>
					  <th>Harga</th>
					   <td style='text-align: center;'>Rp <?php echo number_format($row['harga']) ?></td>
                      </tr>
					  
					  <tr>
					  <th>Qty</th>
					  <td style='text-align: center'><?php echo $row['jumlah'] ?></td>
                      </tr>
					  
					  <tr>  
                      <th>Subtotal</th>
					  <td style='text-align: left'>Rp <?php echo number_format($row['subtotal']) ?></td>
                      </tr>
                     
					<?php 
					$no++;
					} ?> 
                  
				   <?php 
		
			include 'keranjang/keranjang_total.php';
			include 'keranjang/keranjang_total2.php';
		  ?>
		  
        <tr>
          <th style="text-align: center; background: #ddd"> Total Berat</th>
		  <th style="text-align: center; background: #ddd">  <?php echo number_format($jumlah_berat_all) ?> gram</th>
		<tr>
		</tr>
          <th style="text-align: center; background: #ddd">Total Harga</th><th style="text-align: left; background: #ddd">Rp <?php echo number_format($subtotal_all) ?>,- </th>
        </tr>
		</tbody>
                </table>
				
              </div><!-- /.col -->
            </div><!-- /.row -->

            <div class="">
              <div class="col-xs-12">
                <div class="table-responsive">
				
	
<?php 
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
	 <?php } ?>	 
		
<?php $grand_total =  $harga_ongkir + $subtotal_all ?>
		<p>Total biaya invoice ini adalah sebesar <h1 style="color:#d9534f">Rp <?php echo  number_format($grand_total, 0, ',', '.').',-'; ?></h1></p>
		<br>
                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
		  <?php if  ($status_trx <= 1) { ?>
            <div class="caption-full">
			<hr>
              <form method="post" id="form-register" action="../konfirmasi/konfirmasi_kirim.php" enctype="multipart/form-data">
                <div class="">
                  <div class="col-md-12">
                    <div class="box box-primary">
                      <div class="box-body">
                        <div class="row">
                          <div class="col-xs-3"><label>No. Invoice</label>
                            <input class="form-control" name="no_invoice" type="text" id="no_invoice" placeholder="Isikan angka saja" value="<?php echo $notransaksi ?>" readonly/>
                          </div>
                          <div class="col-xs-5"><label>Nama Pengirim</label>
                            <input class="form-control" name="nama_pengirim" type="text" id="nama_pengirim" value="<?php echo $nama ?>" readonly/>
                          </div>
                          <div class="col-xs-4"><label>Email</label>
                            <input class="form-control" name="email" type="text" id="email" value="<?php echo $email ?>" readonly/>
                          </div>
                        </div><br/>
                        <div class="row">
                          <div class="col-xs-6"><label>Jumlah Transfer</label>
                            <input class="form-control" name="jml_transfer" type="text" id="jml_transfer" placeholder="Isikan angka saja" value="<?php echo $grand_total ?>" readonly/>
                          </div>
                          <div class="col-xs-6"><label>Tanggal Transfer</label>
                            <input required class="form-control" name="tgl_transfer" type="text" id="tgl_transfer" value="<?php echo date("Y-m-d") ?>"/>
                          </div>
                        </div>
						<br/>
						<br/>
						
						<div class="row">
						<label style="padding:7px 0 0 15px" class="control-label col-xs-2 ">Upload Struk</label>
						<div class="col-xs-8" style="padding-left:15px;">
							<input class="form-control" id="uploadFile" placeholder="Upload File scan struk pembayaran ATM Anda (jpg)" disabled />
						</div>
						<div class="col-xs-2" style="padding-right:15px;">
						
						   <div class="file-upload btn btn-block btn-success">		
								<span><i class="fa fa-image"></i>&nbsp;&nbsp;<b>Foto Struk</b></span>
								<input required id="uploadBtn" name="foto_struk" type="file" class="upload" />
								
							</div>
						</div>
					</div>
                       
                      </div><!-- /.box-body -->
					  <br/>
                      <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
		  <?php } ?>
          </div>
        </div>

       
        
      </div>
      
      

    </div>
    <hr/>

      <?php include 'footer.php'; ?>
     <link href="<?php echo $base_url ?>Admin/template/plugins/datepicker/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="<?php echo $base_url ?>Admin/template/plugins/datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
    $(function()
    {
      $('#tgl_transfer').datepicker({autoclose: true,todayHighlight: true,format: 'yyyy-mm-dd'})
    });
    </script>
    <!-- Fungsi JS untuk membuat form hanya bisa diisi oleh angka saja -->
    <script type="text/javascript">
    function isNumberKey(evt)
    {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))

      return false;
      return true;
    }
    </script>
	<!-- script file_surat -->
<script>
	document.getElementById("uploadBtn").onchange = function () {
		document.getElementById("uploadFile").value = this.value;
	};
</script>	
  </body>
</html>