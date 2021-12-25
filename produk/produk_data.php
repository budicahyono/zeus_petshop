<div class="row">
  <div class="col-sm-12 ">
	<div class="row">

      <div class="col-md-4">
        <a  href="<?php echo $base_url ?>images/produk/<?php echo $produk['img']; ?>" title="<?php echo $produk['nama_produk']; ?>" id="fancybox" class="thumbnail" data-fancybox-group="group1">
          <img  src="<?php echo $base_url ?>images/produk/350px_<?php echo $produk['img']; ?>" alt="<?php echo $produk['nama_produk']; ?>"  style="width:90%"	/>
        </a>
      </div>
      <div class="col-md-8">
	  <table class="table table-bordered table-striped">
		<tr>
		<th>Kategori</th>
		<td>: <a class="btn-primary label" href="<?php echo $base_url ?>kategori/<?php echo $produk['id_kat']; ?>"><?=$produk['judul_kat'];?> </a></td>
		</tr>
		<tr>
		
		<tr>
		<th>Stok</th>
		<td>: <?php echo $produk['stok']; ?>  unit </td>
		</tr>
		<tr>
		<th>Berat</th>
		<td>: <?php echo number_format($produk['berat']); ?>   gram</td>
		</tr>
       </table>
      
        <h1>
          <strong>
            <font color="red">HARGA : Rp <?php echo $harga ?>
            </font>
          </strong>
        </h1><br/>
        <a href="<?php echo $base_url ?>beli/<?php echo $produk['id_produk']; ?>">
          <button type="submit" name="submit" class="btn btn-primary">Beli</button>
        </a>
		
     

      <br/><br/>
      
      <div class="thumbnail" style="padding:10px;overflow:auto;height:213px;">
        <b>Deskripsi</b>:<br/>
        <?php echo $produk['deskripsi']; ?>
      </div>
	  
     
<?php $id_produk_asli = $produk['id_produk']; ?>
   
	</div>
        <div class="col-lg-12 ">
          <h3 class="kotak"><span class="glyphicon glyphicon-list-alt kotak-icon"></span> Produk Terkait</h3>
        </div>
      
    <?php include "related.php";?>
  </div>
 
 </div>

</div>