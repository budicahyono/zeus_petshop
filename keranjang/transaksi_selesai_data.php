<?php
include 'faktur_selesai.php';                     // Panggil data faktur
include 'keranjang_ongkir.php';

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
<h4></h4>

<p align="right">
  <a target="blank" href='invoice/<?php echo $faktur; ?>' type='button' class='btn btn-primary'>
      <span class='glyphicon glyphicon-download' aria-hidden='true'></span> Download Invoice
  </a>
</p>

<div id="no-more-tables">
  <?php   
  
  // Membuat join query 3 tabel: transaksi, transaksi_detail dan produk

				  
	  $cek_invoice =  mysqli_query($conn,"SELECT * FROM transaksi t, transaksi_detail td, produk p
										  WHERE t.notransaksi=td.notransaksi AND p.id_produk = td.id_produk AND t.notransaksi = '$faktur'  AND t.username = '$sesen_username' AND t.status = 1");			  
  if(mysqli_num_rows($cek_invoice) == 0)
  {echo "<center><h4>Keranjang belanja anda masih kosong</h4></center>";}
  else
  {
   ?>
    <table class='col-md-12 table-bordered table-striped table-condensed cf'>
      <thead class='cf'>
        <tr>
          <th>No.</th>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Berat</th>
          <th>J.Berat</th>
          <th>Qty</th>
          <th>Sub Total</th>
        </tr>
      </thead>
    <?php
    $no = 1;
    while($data_keranjang = mysqli_fetch_array($cek_invoice))
    {
      $harga = number_format($data_keranjang['harga'], 0, ',', '.');
      $subtotal     = number_format($data_keranjang['subtotal'], 0, ',', '.');
	  $deadline        = date("Y-m-d", strtotime('+2 days',strtotime($data_keranjang['tgl_checkout'])));
	?>
      
      <tbody>
        <tr>
          <td data-title='No.' align='center'><?php echo $no ?></td>
          <td data-title='Nama Produk' align='left'><a href='<?php echo $base_url ?>produk/<?php echo $data_keranjang['judul_seo'] ?>.html'><?php echo $data_keranjang['nama_produk'] ?></a></td>
          <td data-title='Harga Diskon' align='right'>Rp <?php echo $harga ?>,-</td>
          <td data-title='Berat' align='center'><?php echo number_format($data_keranjang['berat']) ?> gram</td>
          <td data-title='Jumlah Berat' align='center'><?php echo number_format($data_keranjang['jumlah_berat']) ?> gram</td>
          <td data-title='Jumlah Berat' align='center'><?php echo $data_keranjang['jumlah'] ?></td>
          <td data-title='Sub Total' align='right'>Rp <?php echo $subtotal ?>,-</td>
        </tr>
		<?php
      $no++;
    }
  }
  
  

include 'keranjang_total.php';
include 'keranjang_total2.php';
  ?>
  <thead class='cf'>
        <tr>
          <th> </th>
          <th></th>
          <th></th>
          <th></th>
          <th style="text-align:center"> <?php echo number_format($jumlah_berat_all) ?> gram</th>
          <th></th>
          <th style="text-align:right">Rp <?php echo number_format($subtotal_all) ?>,- </th>
        </tr>
      </thead>
</table>
</div>
<p style="margin-top:100px">&nbsp;</p>

<?php 

	 for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
	 ?>
	 <h5 style="padding:10px;font-weight:bold">JASA PENGIRIMAN : <?php echo strtoupper($data['rajaongkir']['results'][$i]['name']); ?></h5>
	 <form method="post" id="form2" action="checkout.php">
		<input type="hidden" name="weight" value="<?php echo $weight ?>">
		<input type="hidden" name="origin" value="<?php echo $origin ?>">
		<input type="hidden" name="destination" value="<?php echo $destination ?>">
	 <table   class="table table-bordered table-striped table-condensed cf">
						 <tr>
							 <th>No.</th>
							 <th>Service</th>
							 <th>Deskripsi</th>
							 <th>Tarif</th>
							 <th>Lama Pengiriman</th>
						 </tr>
						
						  <?php
						  $no = 1;
						   for ($j=0; $j < count($data['rajaongkir']['results'][$i]['costs']); $j++) {
								if ($data['rajaongkir']['results'][$i]['costs'][$j]['service'] == $service)
								{			
								
						   ?>	 
						    <tr>
							 <td><?php echo $no;?></td>
							<td align="right">
							 <?php echo strtoupper($data['rajaongkir']['results'][$i]['costs'][$j]['service'] ); ?></td>
							 <td align="right"><?php echo strtoupper($data['rajaongkir']['results'][$i]['costs'][$j]['description'] ); ?></td>
							 <td align="right">
								 <?php
							  
								  echo $harga = "Rp ".number_format($data['rajaongkir']['results'][$i]['costs'][$j]['cost'][0]['value']);
								  $harga_ongkir =
								  $data['rajaongkir']['results'][$i]['costs'][$j]['cost'][0]['value']
							
							   ?>	
							 </td>
							 <td align="right">
								 <?php
							   
								   echo $etd = $data['rajaongkir']['results'][$i]['costs'][$j]['cost'][0]['etd']." hari";
								  
							   ?>	
							 </td>
							 
							 </tr>
						   <?php
								$no++;		
								}	
						   } ?> 
						 
						
					 </table>
	 <?php } ?>
		</form>
		
<hr/>
<?php $grand_total = $harga_ongkir + $subtotal_all ?>
<p>Total biaya yang harus Anda bayar adalah sebesar <strong>Rp <?php echo number_format($grand_total, 0, ',', '.').',-';  ?></strong></p>
<p>Apabila telah melakukan pembayaran, mohon konfirmasi ke halaman konfirmasi paling lambat tanggal <b><?php echo tgl_indo($deadline) ?></b> pada  header di atas atau pada link berikut: <a href="<?php echo $base_url.'konfirmasi.html' ?>">klik disini</a></p>
<hr/>
<p>Pembayaran ditujukan ke rekening kami di bawah ini: </p>
<p><b>Bank <?=$bank_admin?>, No.rek: <?=$no_rek_admin?>, An.<?=$nama_admin?></b></p>
<hr/>
<p>Setelah proses verifikasi pembayaran Anda selesai, maka kami akan mengirimkan barang ke:</p>

<p>
<?php
include "ambil_username.php";
?>
  <b>Atas Nama</b>: <?php echo $nama ?><br/>
        <b>No. HP</b>: <?php echo  $telepon ?><br/>
        <b>Alamat</b>: <?php echo  $alamat ?>, <?php echo $data_user['rajaongkir']['results']['city_name'] ?>, <?php echo $data_user['rajaongkir']['results']['province'] ?>, Kode Pos : <?php echo $kopos ?>
		</p>
<hr/>
<p align="center">Terima kasih telah berbelanja bersama kami, Zeus Petshop. Jika butuh bantuan bisa menghubungi kami di <b>Nomor WA: <?=$no_hp_admin?></b>.</p>