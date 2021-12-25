 <div class="row text-center">

<?php 



// Memanggil data dari tabel produk diurutkan dengan id_produk secara DESC dan dibatasi sesuai $start dan $per_halaman
$data     = mysqli_query($conn, "SELECT * FROM produk where kat = '$id_kat' ORDER BY id_produk DESC ");
$numrows  = mysqli_num_rows($data); 
if($numrows == 0)
  {
    echo "Belum ada data";
  }
  else
  {
?>

<?php
  while($row = mysqli_fetch_assoc($data)) 
  {
    
    $harga = number_format($row['harga'], 0, ',', '.').",-";
?>


    <div class="col-md-3 col-sm-6 hero-feature">
    <div class="thumbnail">
     <div class="title">
          <a href="<?php echo $base_url ?>produk/<?php echo $row['judul_seo']; ?>.html" >
            <h4><?php echo $row['nama_produk']; ?></h4>
          </a>
		 </div> 
      <center><img  src="<?php echo $base_url ?>images/produk/<?php echo $row['img']; ?>" alt="<?php echo $row['nama_produk']; ?>"  width="90%"/></center>
      <div class="caption">
      
        <h4><font color="red">Rp <?php echo $harga ?></font></h4>
        <a href="<?php echo $base_url ?>beli/<?php echo $row['id_produk']; ?>" class="btn btn-primary">Beli</a> 
        <a href="<?php echo $base_url ?>produk/<?php echo $row['judul_seo']; ?>.html" class="btn btn-default">Detail</a>
      </div>
    </div>
	</div>
  <?php 
  // Mengakhiri pengulangan while


}
  }
  
?>

</div>