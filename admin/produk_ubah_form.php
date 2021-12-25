<?php
$id_produk        = mysqli_real_escape_string($conn, $_GET['id_produk']);
$sql              = "SELECT * FROM produk WHERE id_produk = $id_produk ";
$result           = mysqli_query($conn, $sql);
$data             = mysqli_fetch_array($result);
$tampil_deskripsi = str_replace("<br>","\r\n",$data['deskripsi']);
?>
<form action="produk_ubah_proses.php" method="post" enctype="multipart/form-data">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box ">
        <div class="box-body">
          <input name="id_produk" type="hidden" id="id_produk" value="<?php echo $data['id_produk'] ?>">
          <div class="form-group"><label>Judul Produk</label>
            <input class="form-control text-capitalize" name="nama_produk" type="text" id="nama_produk" size="30" value="<?php echo $data['nama_produk'] ?>"/>
          </div>
          <div class="form-group"><label>SEO Deskripsi</label>
            <input class="form-control" name="seo_deskripsi" type="text" id="seo_deskripsi" value="<?php echo $data['seo_deskripsi'] ?>"/>
          </div>
          <div class="form-group"><label>SEO Keywords</label>
            <input class="form-control text-capitalize" name="seo_keywords" type="text" id="seo_keywords" value="<?php echo $data['seo_keywords'] ?>"/>
          </div>
          <div class="form-group"><label>Deskripsi Produk</label>
            <textarea class="form-control text-capitalize" rows="10"  name="deskripsi"><?php echo "$tampil_deskripsi" ?></textarea>
          </div>
         
        </div><!-- /.box-body -->
      </div><!-- /.box -->
      <!-- left column -->
    </div>

    <!-- right column -->
     <!-- right column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box  ">
        <div class="box-body">
          <div class="row">
            <div class="col-xs-6"><label>Harga </label>
              <input class="form-control" name="harga" value="<?=$data['harga']?>" type="text" id="b" size="30" placeholder="Isi angka saja" onkeyup="hitung();"/>
            </div>
            
           
            <div class="col-xs-6"><label>Kategori</label>
              <br/>
              <select name="cmbkat" id="cmbkat" class="form-control" required>
              <option value="">--Pilih Kategori--</option>
                <?php
                $query = "SELECT * FROM kategori ORDER BY judul_kat";
                $sql = mysqli_query($conn, $query);
                while($r = mysqli_fetch_array($sql)){ ?>
				
				<option value="<?=$r['id_kat']?>"  <?php if ($r['id_kat'] == $data['kat']) echo "selected"?> ><?=$r['judul_kat']?></option>
				<?php
				}
                ?>
              </select>
             
            </div>
			
			
           
          </div><br/>
          <div class="row">
             <div class="col-xs-6"><label>Berat (gram)</label>
              <input class="form-control" name="berat" value="<?=$data['berat']?>" type="text" size="30" placeholder="Isi angka saja" />
            </div>
            <div class="col-xs-6"><label>Stok</label>
              <input class="form-control" name="stok" value="<?=$data['stok']?>" type="text" id="stok" size="30" placeholder="Angka saja"/>
            </div>
            
          </div><br/>
		   <div class="form-group"><label>Gambar Sebelumnya</label>
            <br/>
            <?php echo "<img src='../images/produk/100px_".$data['img']."' width='100' >"; ?>
          </div>
          <div class="form-group"><label>* Foto Baru</label><br/>
            <input type="file" name="img" id="img" onchange="tampilkanPreview(this,'preview')" />
			<input type="hidden" name="img_hidden"  value="<?=$data['img']?>"  />
			
            <br><b>Preview Gambar</b><br>
            <img id="preview" src="" alt="" width="35%" />
			 
          </div>
		   
        </div><!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" name="submit" class="btn btn-success">Submit</button>
          <button type="reset" name="reset" class="btn btn-danger">Reset</button>
        </div>
      </div><!-- /.box -->
      <!-- right column -->
    </div>
  </div>
</form>

<?php 
include "../fungsi/imgpreview.php"; // Preview gambar yang akan diupload
?>