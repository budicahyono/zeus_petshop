<div class="row text-center">
  <?php 
  $query   = "SELECT * FROM produk ORDER BY id_produk DESC LIMIT 0,8";
  $hasil   = mysqli_query($link, $query);
  $numrows = mysqli_num_rows($hasil);
  if($numrows == 0)
  {
    echo "Belum ada data";
  }
  else
  {
    while($data = mysqli_fetch_array($hasil))
    {
      $harga = number_format($data['harga'], 0, ',', '.').",-";
  ?>
      <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
		<div class="title">
          <a href="<?php echo $base_url ?>produk/<?php echo $data['judul_seo']; ?>.html" >
            <h4><?php echo $data['nama_produk']; ?></h4>
          </a>
		 </div> 
          <center><img alt="<?php echo $data['nama_produk']; ?>" src="<?php echo $base_url ?>images/produk/350px_<?php echo $data['img']; ?>"  width="90%"/></center>
          <div class="caption">
            <h4><font color="red">Rp <?php echo $harga ?></font></h4>
            <a href="<?php echo $base_url ?>beli/<?php echo $data['id_produk']; ?>" class="btn btn-primary">Beli</a> 
            <a href="<?php echo $base_url ?>produk/<?php echo $data['judul_seo']; ?>.html" class="btn btn-default">Detail</a>
          </div>
        </div>
      </div>
<?php 
    } 
  } 
?>
</div>