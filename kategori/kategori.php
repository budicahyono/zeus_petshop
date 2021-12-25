<?php 
$id_kat = mysqli_real_escape_string($conn,$_GET['id']);

$query     = "SELECT * FROM produk, kategori WHERE id_kat = '$id_kat' AND produk.kat= kategori.id_kat ORDER BY produk.id_produk DESC";
$hasil     = mysqli_query($conn,$query);
$row  = mysqli_fetch_array($hasil);

$numrows   = mysqli_num_rows($hasil);
if($numrows == 0){echo "<script>alert('Belum ada data');location.replace('$base_url')</script>";}
 include 'navbar.php'; ?>
<div class="container-fluid">

<div class="row">
        <div class="col-lg-12 ">
          <h3 class="kotak"><span class="glyphicon glyphicon-th-list kotak-icon"></span> <?=$row	['judul_kat']?></h3>
        </div>
      </div>
<h4 style="text-align:center" ><b class="badge">Ada <?php echo $numrows; ?> barang di kategori ini</b></h4>
   
              <?php include 'kategori_data.php'; ?>
            </div>
          </div>
        </div>

       

      <?php include 'footer.php'; ?>

    </div>
   
  </body>
</html>