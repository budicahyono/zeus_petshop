<style>
	.link{
		color:#d51d1a;
		text-decoration:none;
	}
</style>
<div class="row text-center" style="padding:0">
<div class="col-sm-12 hero-feature">
        <div class="thumbnail">
		<div class="title">
		 <a class="disabled">
            <h4>Produk Yang diorder</h4>
		</a>	
		  </div>



<div id="no-more-tables">

	<?php		
	include 'faktur.php';                     // Panggil data faktur
	// Membuat join query 3 tabel: transaksi, transaksi_detail dan produk
	$cek_invoice = 	mysqli_query($conn,"SELECT *FROM transaksi_detail
									LEFT JOIN transaksi ON transaksi.notransaksi = transaksi_detail.notransaksi
									INNER JOIN produk ON produk.id_produk = transaksi_detail.id_produk
									WHERE transaksi.notransaksi = '$faktur' 
									AND transaksi.username = '$sesen_username'  
									AND transaksi.status = 0");
	if(mysqli_num_rows($cek_invoice) == 0)
	{echo "<center><h4>Keranjang belanja anda masih kosong</h4></center>";}
	else
	{
		?>
		<table id="example1" class='col-md-12 table-bordered table-striped table-condensed' style="width:100%">
			<thead >
				<tr>
				  <th>No.</th>
				  <th>Nama Produk</th>
				  <th>Stok</th>
				  <th>Harga</th>
				  <th>Berat</th>
				  <th>J.Berat</th>
				  <th>Qty Awal</th>
				  <th>Edit Qty</th>
				  <th>Aksi</th>
				  <th>Sub Total</th>
				</tr>
			</thead>
		<?php	
			$i = 1;

		while($data_keranjang = mysqli_fetch_array($cek_invoice))
		{
			$harga =$data_keranjang['harga'];
			$subtotal 		=$data_keranjang['subtotal'];
		?>
		
			<tbody>
			<form method="post" id="form1" action="keranjang/keranjang_update.php">
				<tr>
					<td data-title='No.' align='center'><?php echo $i ?></td>
		    	<td data-title='Nama Produk' align='left'><a class="link" href='<?php echo $base_url ?>produk/<?php echo $data_keranjang['judul_seo'] ?>.html'><?php echo $data_keranjang['nama_produk'] ?></a></td>
			    <td data-title='stok' align='center'><?php echo $data_keranjang['stok'] ?> unit</td>
			    <td data-title='Harga Diskon' align='center'>Rp <?php echo number_format($harga) ?>,-</td>
			    <td data-title='Berat' align='center'><?php echo number_format($data_keranjang['berat'])  ?> gram</td>
			    <td data-title='Jumlah Berat' align='center'> <?php echo number_format($data_keranjang['jumlah_berat'])  ?> gram</td>
			    <td data-title='Qty_awal' align='center'>
				<?php echo $data_keranjang['jumlah'] ?>
			    </td>
				<td data-title='Qty' align='center'>
			      <input type='hidden' name='id' value='<?php echo $data_keranjang['id_produk'] ?>'/>
			      <input type='text' name='jumlah' value='<?php echo $data_keranjang['jumlah'] ?>' size='3' onkeypress='return isNumberKey(event)'/>
			    </td>
			    <td data-title='Aksi' align='center'>
			    
			      	<button name='update' type='submit' class='btn btn-warning' aria-label='Left Align' title='Update'>
							  <span class='glyphicon glyphicon-refresh' aria-hidden='true'></span>
							</button>
			      
			      <a OnClick="return confirm('Apakah Anda yakin?')" class='btn btn-danger' href='keranjang/keranjang_hapus.php?id=<?php echo $data_keranjang['id_produk'] ?>'>
							  <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
							
			      </a>
			    </td>
			    <td data-title='Sub Total' align='center'>Rp <?php echo number_format($subtotal) ?>,-</td>
			  </tr>
			  </form>
			</tbody>  
		<?php 	  
			$i++;
		}
		$no = $i-1;
	?>
	<input type="hidden" name="n" value="<?php echo $no ?>" />
	
</table>

<?php
	}
// Membuat join query 3 tabel: transaksi, transaksi_detail dan produk
	$cek_invoice = 	mysqli_query($conn,"SELECT *FROM transaksi_detail
									LEFT JOIN transaksi ON transaksi.notransaksi = transaksi_detail.notransaksi
									INNER JOIN produk ON produk.id_produk = transaksi_detail.id_produk
									WHERE transaksi.notransaksi = '$faktur' 
									AND transaksi.username = '$sesen_username'  
									AND transaksi.status = 0");
	if(mysqli_num_rows($cek_invoice) == 0)
	{echo "<center><h4>Keranjang belanja anda masih kosong</h4></center>";}
	else
	{
?>		

<table id="table-mini" class='col-md-12 table-bordered table-striped table-condensed' style="width:100%">
			
		<?php	
			$i = 1;

		while($data_keranjang = mysqli_fetch_array($cek_invoice))
		{
			$harga =$data_keranjang['harga'];
			$subtotal 		=$data_keranjang['subtotal'];
		?>
		
			<tbody>
			  <form method="post" id="form2" action="keranjang/keranjang_update.php">
			<tr>
				  <th rowspan="9" valign="top">No.<?php echo $i ?></th>	  
				  <th>Nama Produk</th>
				  <td data-title='Nama Produk' align='left'><a class="link" href='<?php echo $base_url ?>produk/<?php echo $data_keranjang['judul_seo'] ?>.html'><?php echo $data_keranjang['nama_produk'] ?></a></td>
			</tr>
			<tr>	
				  <th>Harga</th>
				  <td data-title='Harga Diskon' align='center'>Rp <?php echo number_format($harga) ?>,-</td>
			</tr>
			<tr>	
				  <th>Stok</th>
				  <td data-title='Stok' align='center'><?php echo $data_keranjang['stok'] ?> unit</td>
			</tr>
			<tr>	  
				  <th>Berat</th>
				  <td data-title='Berat' align='center'><?php echo number_format($data_keranjang['berat'])  ?> gram</td>
			</tr>
			<tr>	  
				  <th>J.Berat</th>
				  <td data-title='Jumlah Berat' align='center'> <?php echo number_format($data_keranjang['jumlah_berat'])  ?> gram</td>
			</tr>
			<tr>	  
				  <th>Qty Awal</th>
				  <td data-title='Qty_awal' align='center'>
			      <?php echo $data_keranjang['jumlah'] ?>
			    </td>
			</tr>
			<tr>	  
				  <th>Edit Qty</th>
				  <td data-title='Qty' align='center'>
			      
			      <input type='hidden' name='id' value='<?php echo $data_keranjang['id_produk'] ?>'/>
			      <input type='text' name='jumlah' value='<?php echo $data_keranjang['jumlah'] ?>' size='3' onkeypress='return isNumberKey(event)'/>
			    </td>
			</tr>
			<tr>	  
				  <th>Aksi</th>
				  <td data-title='Aksi' align='center'>
			    
			      	<button name='update' type='submit' class='btn btn-warning' aria-label='Left Align' title='Update'>
							  <span class='glyphicon glyphicon-refresh' aria-hidden='true'></span>
							</button>
			      
			      <a OnClick="return confirm('Apakah Anda yakin?')" class='btn btn-danger' href='keranjang/keranjang_hapus.php?id=<?php echo $data_keranjang['id_produk'] ?>'>
							  <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
							
			      </a>
			    </td>
			</tr>
			<tr>	  
				  <th>Sub Total</th>
				   <td data-title='Sub Total' align='center'>Rp <?php echo number_format($subtotal) ?>,-</td>
				</tr>
			 </form>	
			 </tbody>
		<?php 	  
			$i++;
		}
		$no = $i-1;
	?>
	<input type="hidden" name="n" value="<?php echo $no ?>" />
</table>

<?php }
	?>

<hr/>


	

 </div>
 
 <form method="post" id="form2" action="<?php echo $base_url ?>lihat_ongkir.php">
	<p style="margin-top:100px">&nbsp;</p>
	<?php 
	include 'keranjang_total_berat.php';
	include 'ambil_kota_web.php';
	include 'ambil_kota_user.php';
	?>
	<input type="hidden" name="weight" value="<?php echo $total_berat ?>">
	<input type="hidden" name="origin" value="<?php echo $kota_asal ?>">
	<input type="hidden" name="destination" value="<?php echo $kota_user ?>">
	
 	<p>
	<?php if (mysqli_num_rows($cek_invoice) > 0) { ?>
 		<a class='btn btn-danger' href="keranjang/keranjang_hapus_all.php" OnClick="return confirm('Apakah Anda yakin?');">
			  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Kosongkan Keranjang Belanja
			</a>
		<p style="margin-bottom:-20px">&nbsp;</p>	
		<button type='submit' class='btn btn-success' aria-label='Left Align' onclick="return confirm('Anda yakin? Pastikan Anda sudah mengupdate jumlah barang yang anda inginkan pada tombol aksi')">
		<span class='glyphicon glyphicon-check' aria-hidden='true'></span> Lihat Ongkir		
		</button>
	<?php } ?>	
		<a href="<?php echo $base_url ?>" class="btn btn-primary" aria-label="Left Align" >
			  <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>  Lanjut Belanja
		</a>
		
	</p>
	</form>
	</div>
</div>
</div>

	
