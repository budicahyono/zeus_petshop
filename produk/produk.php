<?php 

// Mengambil nilai berdasarkan id_produk dengan metode GET
$id_produk = mysqli_real_escape_string($conn,$_GET['id_produk']);

$query_produk        = "SELECT * FROM produk P, 
				kategori K where K.id_kat = P.kat 
                and P.judul_seo = '$id_produk'";
$hasil_produk        = mysqli_query($conn,$query_produk);
$produk       = mysqli_fetch_array($hasil_produk);
$harga = number_format($produk['harga'], 0, ',', '.').",-";

if(mysqli_num_rows($hasil_produk) == 0)
{echo "<script>alert('Belum ada data');location.replace('$base_url')</script>";}

?>

    <?php include 'navbar.php'; ?>

    <div class="container">
	<div class="row">
        <div class="col-lg-12 ">
          <h3 class="kotak"><span class="glyphicon glyphicon-phone kotak-icon"></span> <?=$produk['nama_produk']?></h3>
        </div>
      </div>	
	
      <?php include 'produk_data.php'; ?>

      

     

    </div>
	<hr>
	<br>
	 <?php include 'footer.php'; ?>
    
    <!-- Memanggil file JS -->
   
   
  </body>
</html>