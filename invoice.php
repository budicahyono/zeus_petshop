<?php session_start(); ob_start(); 
include 'config.php';                     // Panggil koneksi ke database
include 'faktur_selesai.php';             // Panggil data faktur yang telah selesai
include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public
include 'fungsi/cek_login_public.php'; 		// Panggil fungsi cek login public
include 'fungsi/tgl_indo.php';            // Panggil fungsi tanggal indonesia

$sql_admin 		= mysqli_query($conn,"SELECT *  FROM user WHERE id_user = '1' ");
$hasil_admin 							= mysqli_fetch_array($sql_admin);


// isi admin
$nama_admin 			= $hasil_admin['nama'];
$no_rek_admin 			= $hasil_admin['no_rek'];
$bank_admin 			= $hasil_admin['bank'];
$no_hp_admin 			= $hasil_admin['no_hp'];


include 'keranjang/keranjang_ongkir.php';


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



$notransaksi 	 = 	mysqli_real_escape_string($conn,$_GET['id']);
// Membuat join query 3 tabel: transaksi, transaksi_detail dan produk



$hasil_invoice =  mysqli_query($conn,"SELECT * FROM transaksi t, transaksi_detail td, produk p
							  WHERE t.notransaksi=td.notransaksi AND p.id_produk = td.id_produk AND t.notransaksi = '$faktur'  AND t.username = '$sesen_username' ");							
if(mysqli_num_rows($hasil_invoice) == 0)
{die ("<script>alert('Invoice yang Anda cari tidak ditemukan');location.replace('$base_url')</script>");}
?>  

<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->  
	<head>  
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  
    <title>Invoice #<?php echo $notransaksi; ?></title>
    <style type="text/css">
		.tabel2 {
		  width: 100%;
		  border-collapse: collapse;
		  border-spacing: 0;
		}
		.tabel2 tr.odd td {
		    bacgramround-color: #f9f9f9;
		}
		.tabel2 th, .tabel2 td {
	    padding: 4px 5px;
	    line-height: 20px;
	    text-align: left;
	    vertical-align: top;
	    border: 1px solid #dddddd;
		}
		</style>
  </head>
  <body>  
		<table>
		  <tr>
		    <td>
		      <font style="font-size: 25px; text-align: left"><br/><b>Zeus Petshop</b></font><br/>
		      <font style="font-size: 15px; text-align: left">
		        <br/>Alamat: Jalan Reremi Palapa, Manokwari, Papua Barat
		      </font>        
		    </td>
		  </tr>
		</table>

		<hr/>

		<h3 align="center">NO. INVOICE: #<?php echo $notransaksi; ?></h3>

		<table class="tabel2" align="left">
		  <thead>
		    <tr>
		      <td style="text-align: center; bacgramround: #ddd"><b>No.</b></td>
		      <td style="text-align: center; bacgramround: #ddd"><b>NAMA PRODUK</b></td>
		      <td style="text-align: center; bacgramround: #ddd"><b>BERAT</b></td>
		      <td style="text-align: center; bacgramround: #ddd"><b>JUMLAH BERAT</b></td>
		      <td style="text-align: center; bacgramround: #ddd"><b>HARGA</b></td>
		      <td style="text-align: center; bacgramround: #ddd"><b>QTY</b></td>
		      <td style="text-align: center; bacgramround: #ddd"><b>SUBTOTAL</b></td>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php
        $i   = 1;
        while ($data_invoice = mysqli_fetch_array($hasil_invoice))
        {
			
        	$harga = number_format($data_invoice['harga'], 0, ',', '.');
        	$subtotal 		= number_format($data_invoice['subtotal'], 0, ',', '.')
        ?>
          <tr>
            <td style='text-align: center; width:20px'><?php echo $i ?></td>
            <td style='text-align: left; width:200px'><?php echo $data_invoice['nama_produk'] ?></td>
            <td style='text-align: center; width:50px'><?php echo $data_invoice['berat'] ?> gram</td>
            <td style='text-align: center; width:50px'><?php echo $data_invoice['jumlah_berat'] ?> gram</td>
            <td style='text-align: right; width:65px'><?php echo $harga.',-' ?></td>
            <td style='text-align: center; width:50px'><?php echo $data_invoice['jumlah'] ?></td>
            <td style='text-align: right; width:70px'>Rp <?php echo $subtotal.',-' ?></td>
          </tr>
        <?php $i++; } ?>
		  </tbody>
		  <?php 
			include 'keranjang/keranjang_total.php';
			include 'keranjang/keranjang_total2.php';
		  ?>
		  
        <tr>
          <th style="text-align: center; bacgramround: #ddd"> </th>
          <th style="text-align: center; bacgramround: #ddd"></th>
          <th style="text-align: center; bacgramround: #ddd"></th>
          <th style="text-align: center; bacgramround: #ddd">  <?php echo $jumlah_berat_all ?> gram</th>
          <th style="text-align: center; bacgramround: #ddd"></th>
          <th style="text-align: center; bacgramround: #ddd"></th>
          <th style="text-align: right; bacgramround: #ddd">Rp <?php echo number_format($subtotal_all) ?>,- </th>
        </tr>
     
		</table>
		<p style="margin-top:10px"></p>

	<?php 
	 for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
	 ?>
	 <div style="margin-right:10px; padding:10px 0 10px 10px;font-weight:bold; background: #ddd; display: block">JASA PENGIRIMAN : <?php echo strtoupper($data['rajaongkir']['results'][$i]['name']); ?></div>
	 <p style="margin-top:10px"></p>
		<table  class="tabel2" align="left">
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
			  $no = 1;
			   for ($j=0; $j < count($data['rajaongkir']['results'][$i]['costs']); $j++) {
					if ($data['rajaongkir']['results'][$i]['costs'][$j]['service'] == $service)
					{			

			   ?>
			<tbody>   
				<tr>
				 <td style=" line-height: 20px; padding: 4px 5px; text-align: center;"><?php echo $no?></td>
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
		
<?php $grand_total = $harga_ongkir + $subtotal_all ?>
		<p>Total biaya yang harus Anda bayar adalah sebesar <strong>Rp <?php echo number_format($grand_total, 0, ',', '.').',-'; ?></strong></p>
		<p>Apabila telah melakukan pembayaran, mohon konfirmasi ke halaman konfirmasi pada header di atas.</p>
		<hr/>
		<p>Pembayaran ditujukan ke rekening kami di bawah ini: </p>
		<p><b>Bank <?=$bank_admin?>, No.rek: <?=$no_rek_admin?>, An.<?=$nama_admin?></b></p>
		<hr/>
		<p>Setelah proses verifikasi pembayaran Anda selesai, maka kami akan mengirimkan barang ke:
		<br>
		
		<?php
include "ambil_username.php";
?>
		 <b>Atas Nama</b>: <?php echo $nama ?><br/>
        <b>No. HP</b>: <?php echo  $telepon ?><br/>
          <b>Alamat</b>: <?php echo  $alamat ?>, <?php echo $data_user['rajaongkir']['results']['city_name'] ?>, <?php echo $data_user['rajaongkir']['results']['province'] ?>, Kode Pos : <?php echo $kopos ?>
		</p>
		
		<hr/>
		<p align="center">Terima Kasih telah berbelanja bersama kami, Zeus Petshop. Jika butuh bantuan bisa menghubungi kami di <b>Nomor WA: <?=$no_hp_admin?></b>.</p>
		<hr/>
	</body>  
</html><!-- Akhir halaman HTML yang akan di konvert -->  

<?php
// ob_get_clean = salah 1 fungsi dalam PHP
$content = ob_get_clean();
// Memanggil class HTML2PDF dari direktori html2pdf pada project kita
include 'html2pdf/html2pdf.class.php';
try
{
  // Mengatur invoice dalam format HTML2PDF
  // Keterangan: L = Landscape/ P = Portrait, A4 = ukuran kertas, en = bahasa, false = kode HTML2PDF, UTF-8 = metode pengkodean karakter
  $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'UTF-8', array(10, 5, 10, 0));
  // Mengatur invoice dalam posisi full page
  $html2pdf->pdf->SetDisplayMode('fullpage');
  // Menuliskan bagian content menjadi format HTML
  $html2pdf->writeHTML($content);
  // Mencetak nama file invoice
  $title = "invoice-$notransaksi.pdf";
  $html2pdf->Output($title); 
}
// Kodingan HTML2PDF
catch(HTML2PDF_exception $e) 
{
  echo $e;
  exit;
}
?>  