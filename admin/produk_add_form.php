<form action="produk_add_proses.php" method="post" enctype="multipart/form-data">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box  ">
        <div class="box-body">
          <div class="form-group"><label>Judul Produk</label>
            <input class="form-control text-capitalize" name="nama_produk" type="text" id="nama_produk" size="30" placeholder="Huruf besar diawal lalu kecil"/>
          </div>
          <div class="form-group"><label>SEO Deskripsi</label>
            <input class="form-control" name="seo_deskripsi" type="text" id="seo_deskripsi" size="30" placeholder="Deskripsi singkat produk"/>
          </div>
          <div class="form-group"><label>SEO Keywords</label>
            <input class="form-control text-lowercase" name="seo_keywords" type="text" id="seo_keywords" size="30" placeholder="Isi dgn huruf kecil semua"/>
          </div>
          <div class="form-group"><label>Deskripsi Produk</label>
            <textarea class="form-control text-capitalize" rows="10"  name="deskripsi"></textarea>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
      <!-- left column -->
    </div>

    <!-- right column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box  ">
        <div class="box-body">
          <div class="row">
            <div class="col-xs-6"><label>Harga </label>
              <input class="form-control" name="harga" type="number" id="b" size="30" placeholder="Isi angka saja" onkeyup="hitung();"/>
            </div>
            
           
            <div class="col-xs-6"><label>Kategori</label>
              <br/>
              <select name="cmbkat" id="cmbkat" class="form-control" required>
              <option value="">--Pilih Kategori--</option>
                <?php
                $query = "SELECT * FROM kategori ORDER BY judul_kat";
                $sql = mysqli_query($conn, $query);
                while($data = mysqli_fetch_array($sql)){echo '<option value="'.$data['id_kat'].'">'.$data['judul_kat'].'</option>';}
                ?>
              </select>
             
            </div>
           
		  
		   
          </div><br/>
          <div class="row">
            
            <div class="col-xs-6"><label>Berat (gram)</label>
              <input class="form-control" name="berat" type="number" size="30" placeholder="Isi angka saja" />
            </div>
            <div class="col-xs-6"><label>Stok</label>
              <input class="form-control" name="stok" type="number" id="stok" size="30" placeholder="Angka saja"/>
            </div>
           
          </div><br/>
          <div class="form-group"><label>* Foto Baru</label><br/>
            <input type="file" name="img" id="img" onchange="tampilkanPreview(this,'preview')" required/>
			<input type="hidden" name="img_hidden"    />
            <br><b>Preview Gambar</b><br>
            <img id="preview" src="" alt="" width="35%"/>
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