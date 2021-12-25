<?php 



if (!isset($_SESSION['username'])) {
	
	echo "<script>alert('Anda Harus Login untuk Konfirmasi Pembayaran!! '); location.replace('register.html')</script>";
	
}  include 'navbar.php'; ?>
<div class="container-fluid" >
      
      <div class="row">
        <div class="col-lg-12 ">
          <h3 class="kotak"><span class="glyphicon glyphicon-th-list kotak-icon"></span> Konfirmasi Pembayaran</h3>
        </div>
      </div>
	  
	  <div class="row text-center" >
<div class="col-sm-12 hero-feature">
        <div class="thumbnail">
		<div class="title">
		 <a class="disabled">
            <h4>Konfirmasi Pembayaran Anda</h4>
		</a>	
		  </div>
			<?php  if ($query_count > 0) {  ?>
			  <h5>Anda Memiliki <span class="badge bg-red"><?php echo $query_count ?> Pesanan</span>  belum dibayar, segera konfirmasi pembayaran </h5>
			  <?php } ?>
			  
    
			<table id="example1" class="table table-bordered table-striped table-responsive">
      <thead>
        <tr>
          <th style="text-align: center">No.Invoice</th>
          <th style="text-align: center">Tanggal Pesan</th>
          <th style="text-align: center">Jatuh Tempo</th>
          <th style="text-align: center">Nama Pemesan</th>
          <th style="text-align: center">Alamat</th>
          <th style="text-align: center">No. Telpon</th>
          <th style="text-align: center">Status</th>
          <th style="text-align: center">Aksi</th>
        </tr>
      </thead>
      <tbody>

      <?php
      $sql = "SELECT t.notransaksi, t.tgl_checkout, c.nama, c.alamat, c.telepon, t.status FROM transaksi t, transaksi_detail td, customer c WHERE t.notransaksi=td.notransaksi AND  t.username = c.username AND t.username = '$sesen_username'  AND t.status < 5 group by t.notransaksi";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0)
      {
        while ($data = mysqli_fetch_array($result))
        {
          ?>
          <tr>
            <td valign='top' align='center'><?php echo $data['notransaksi'] ?></td>
            <td style='text-align: center'><?php echo tgl_indo($data['tgl_checkout']) ?></td>
            <td style='text-align: center'><?php
			$tgl = 	$data['tgl_checkout'];
			 $deadline        = date("Y-m-d", strtotime('+1 days',strtotime($data['tgl_checkout'])));
			 $now 			= date("Y-m-d");
			 $lewat        = date("Y-m-d", strtotime('+2 days',strtotime($data['tgl_checkout'])));
			 echo tgl_indo($deadline); 
			  if ($now >= $lewat and $data['status'] == 1) {
				  //echo "query_hapus";
				  
				
				  $del2 = mysqli_query($conn, "DELETE FROM transaksi_detail WHERE notransaksi = '".$data['notransaksi']."'");
				  $del3 = mysqli_query($conn, "DELETE FROM transaksi WHERE notransaksi = '".$data['notransaksi']."'");
				  
			  }
			?></td>
			<?php 
			 
			
			?>
			
            <td style='text-align: center'><?php echo $data['nama'] ?></td>
            <td style='text-align: center'><?php echo $data['alamat'] ?></td>
            <td style='text-align: center'><?php echo $data['telepon'] ?></td>
           <td style='text-align: center;'>
		  
						<?php if  ($data['status'] == 4) { ?>
						<label  class='label label-success' style="font-size:12px">Dikirim</label>
						<?php } else if  ($data['status'] == 3) { ?>
						<label  class='label label-info' style="font-size:12px">Lunas</label>
						<?php } else if  ($data['status'] == 2) { ?>
						<label  class='label label-warning' style="font-size:12px">Diproses</label>
						<?php } else if  ($data['status'] == 1) { ?>
						<label  class='label label-danger' style="font-size:12px">Belum Bayar</label>
						<?php } ?>
						</td>
            <td style='text-align: right'>
			<?php if  ($data['status'] <= 1) { ?>
              <a href='konfirmasi_detail/<?php echo $data['notransaksi'] ?>'><button type='submit' class='btn btn-success'>Konfirmasi</button></a> 
			 
			  <?php } else { ?>
			   <a href='konfirmasi_detail/<?php echo $data['notransaksi'] ?>'><button type='submit' class='btn btn-primary'>Selengkapnya</button></a> 
			    <?php }  ?>
				 <a target="blank" href='invoice/invoice<?php echo $data['notransaksi']  ?>' type='button' class='btn btn-primary'>
					  <span class='glyphicon glyphicon-download' aria-hidden='true'></span> Download Invoice 
				  </a>
            </td>
          </tr>
		  <?php
        }
      } else {echo "Belum ada data";}
    ?>
    </tbody>
  </table>
  
  <!-- TABLE MINI -->
  
  <table id="table-mini" class="table table-bordered table-striped table-responsive">
      
      
      <?php
      $sql = "SELECT t.notransaksi, t.tgl_checkout, c.nama, c.alamat, c.telepon, t.status FROM transaksi t, transaksi_detail td, customer c WHERE t.notransaksi=td.notransaksi AND  t.username = c.username AND t.username = '$sesen_username'  AND t.status < 5 group by t.notransaksi";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0)
      {
        while ($data = mysqli_fetch_array($result))
        {
          ?>
          <tr>
            <td colspan="2">
			<b>No. Invoice - #<?php echo $data['notransaksi'] ?></b>
			</td>
		  </tr>
		  <tr>	
		    <th style="text-align: center">Tanggal Pesan</th> 
            <td style='text-align: center'><?php echo tgl_indo($data['tgl_checkout']) ?></td>
		  </tr>
		  <tr>	
		    <th style="text-align: center">Jatuh Tempo</th>
            <td style='text-align: center'><?php
			$tgl = 	$data['tgl_checkout'];
			 $deadline        = date("Y-m-d", strtotime('+1 days',strtotime($data['tgl_checkout'])));
			 $now 			= date("Y-m-d");
			 $lewat        = date("Y-m-d", strtotime('+2 days',strtotime($data['tgl_checkout'])));
			 echo tgl_indo($deadline); 
			  if ($now >= $lewat and $data['status'] == 1) {
				  //echo "query_hapus";
				  
				
				  $del2 = mysqli_query($conn, "DELETE FROM transaksi_detail WHERE notransaksi = '".$data['notransaksi']."'");
				  $del3 = mysqli_query($conn, "DELETE FROM transaksi WHERE notransaksi = '".$data['notransaksi']."'");
				  
			  }
			?></td>
			</tr>
		  <tr>
			<th style="text-align: center">Nama Pemesan</th>
            <td style='text-align: center'><?php echo $data['nama'] ?></td>
		  </tr>
		  <tr>
		      <th style="text-align: center">Alamat</th>
            <td style='text-align: center'><?php echo $data['alamat'] ?></td>
		  </tr>
		  <tr>	
		    <th style="text-align: center">No. Telpon</th>
            <td style='text-align: center'><?php echo $data['telepon'] ?></td>
		  </tr>
		  <tr>
		    <th style="text-align: center">Status</th>
           <td style='text-align: center;'>
		  
						<?php if  ($data['status'] == 4) { ?>
						<label  class='label label-success' style="font-size:12px">Dikirim</label>
						<?php } else if  ($data['status'] == 3) { ?>
						<label  class='label label-info' style="font-size:12px">Lunas</label>
						<?php } else if  ($data['status'] == 2) { ?>
						<label  class='label label-warning' style="font-size:12px">Diproses</label>
						<?php } else if  ($data['status'] == 1) { ?>
						<label  class='label label-danger' style="font-size:12px">Belum Bayar</label>
						<?php } ?>
						</td>
			</tr>
		  <tr>			
            <td style='text-align: right' colspan="2">
			<?php if  ($data['status'] <= 1) { ?>
              <a href='konfirmasi_detail/<?php echo $data['notransaksi'] ?>'><button type='submit' class='btn btn-success btn-sm'>Konfirmasi</button></a> 
			 
			  <?php } else { ?>
			   <a href='konfirmasi_detail/<?php echo $data['notransaksi'] ?>'><button type='submit' class='btn btn-primary btn-sm'>Selengkapnya</button></a> 
			    <?php }  ?>
				 <a href='invoice/<?php echo $data['notransaksi']  ?>' type='button' class='btn btn-primary btn-sm' >
					  <span class='glyphicon glyphicon-download' aria-hidden='true'></span> Download Invoice 
				  </a>
            </td>
          </tr>
		  <?php
        }
      } else {echo "Belum ada data";}
    ?>
  </table>
  
  
            
          </div>
        </div>

       
        
      </div>
      
      

    </div>
    <hr/>

      <?php include 'footer.php'; ?>
   <!-- datepicker -->
	 <link href="Admin/template/plugins/datepicker/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="Admin/template/plugins/datepicker/js/bootstrap-datepicker.js"></script>
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