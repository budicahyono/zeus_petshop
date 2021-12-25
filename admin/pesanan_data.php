<div class="box">
  <div class="box-body table-responsive padding">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="text-align: center">No.Invoice</th>
          <th style="text-align: center">Tanggal Pesan</th>
          <th style="text-align: center">Nama Pemesan</th>
          <th style="text-align: center">Alamat</th>
          <th style="text-align: center">No. Telpon</th>
          <th style="text-align: center">Status</th>
          <th style="text-align: center">Aksi</th>
        </tr>
      </thead>
      <tbody id="example1" >

      <?php
      $sql = "SELECT nama, c.username, email, t.notransaksi, telepon, tgl_checkout, alamat, kota, provinsi, kopos, t.status AS status_trx, c.status AS status_c FROM transaksi t, transaksi_detail td, customer c WHERE t.notransaksi=td.notransaksi AND  t.username = c.username AND t.status  < 5 group by t.notransaksi ";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0)
      {
        while ($data = mysqli_fetch_array($result))
        {
          ?>
          <tr>
            <td valign='top' align='center'><?php echo $data['notransaksi'] ?></td>
            <td style='text-align: center'><?php echo tgl_indo($data['tgl_checkout']) ?></td>
            <td style='text-align: center'><?php echo $data['nama'] ?></td>
            <td style='text-align: center'><?php echo $data['alamat'] ?></td>
            <td style='text-align: center'><?php echo $data['telepon'] ?></td>
			<td style='text-align: center'>
						<?php if  ($data['status_trx'] == 4) { ?>
						<label  class='label label-success' style="font-size:12px">Dikirim</label>
						<?php } else if  ($data['status_trx'] == 3) { ?>
						<label  class='label label-info' style="font-size:12px">Lunas</label>
						<?php } else if  ($data['status_trx'] == 2) { ?>
						<label  class='label label-warning' style="font-size:12px">Diproses</label>
						<?php } else if  ($data['status_trx'] == 1) { ?>
						<label  class='label label-danger' style="font-size:12px">Belum Bayar</label>
						<?php } ?>
						</td>
            <td style='text-align: center'>
              <a href='pesanan_detail.php?notransaksi=<?php echo $data['notransaksi'] ?>'><button type='submit' class='btn btn-success'>Selengkapnya</button></a> 
			  <p style="margin-bottom:10px"></p>	
						<a href='pesanan_hapus.php?notransaksi=<?php echo $data['notransaksi'] ?>'><button type='submit' class='btn btn-danger' onclick="return confirm('Anda yakin ingin menghapusnya?')">Hapus</button></a>
            </td>
          </tr>
		  <?php
	  }
	 } else {?>
				  <tr ><td colspan="10" class="text-center">Belum ada data</td></tr>
				  <?php
				  }
				?>
    </tbody>
  </table>
  </div>
</div>