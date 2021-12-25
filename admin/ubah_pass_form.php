<?php
$id_user        = mysqli_real_escape_string($conn, $_GET['id_user']);
$sql              = "SELECT * FROM user WHERE md5(id_user) = '$id_user' ";
$result           = mysqli_query($conn, $sql);
$data             = mysqli_fetch_array($result);
$nama = $data['nama'];
$username = $data['username'];
$foto = $data['foto'];
$id_user = $data['id_user'];
$no_rek_admin 			= $data['no_rek'];
$bank_admin 			= $data['bank'];
$no_hp_admin 			= $data['no_hp'];

?>
<form method="post" action="ubah_pass_proses.php" enctype="multipart/form-data">
    
      <div class="box ">
        <div class="box-body">
		<div class="row">
		<div class="col-lg-6">
		 <div class="form-group"><label>Nama</label>
            <input class="form-control" type="text" name="nama" id="nama" value="<?=$nama?>">
            <input class="form-control" type="hidden" name="id_user" id="id_user" value="<?=$id_user?>">
          </div>
		  <div class="form-group"><label>Bank</label>
            <input class="form-control" type="text" name="bank" id="bank" value="<?=$bank_admin?>">
          </div>
		   <div class="form-group"><label>No.Rekening</label>
            <input class="form-control" type="text" name="no_rek" id="no_rek" value="<?=$no_rek_admin?>">
          </div>
		   <div class="form-group"><label>No.HP</label>
            <input class="form-control" type="text" name="no_hp" id="no_hp" value="<?=$no_hp_admin?>">
          </div>
		  <div class="form-group"><label>Username</label>
            <input class="form-control" type="text" name="username" id="username" value="<?=$username?>">
          </div>
          <div class="form-group"><label>Password Lama</label>
            <input class="form-control" type="password" name="pswlama" id="pswlama">
          </div>
          <div class="form-group"><label>Password Baru</label>
            <input class="form-control" type="password" name="pswbaru" id="pswbaru">
          </div>
          <div class="box-footer">
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
            <button type="reset" name="reset" class="btn btn-danger">Reset</button>
          </div>
        </div>
		<?php if ($foto != "") { ?>
		<div class="col-lg-3">
		
		<div class="form-group"><label>Foto Sebelumnya</label>
            <br/>
            <?php echo "<img src='../images/".$foto."' width='200px' >"; ?>
			<input type="hidden" name="foto_hidden"  value="<?=$foto?>"  />
          </div>
	
		
         
        </div>
			 <?php } ?> 
		<div class="col-lg-3">
		   <div class="form-group"><label>* Foto Baru</label><br/>
            <input type="file" name="foto" id="foto" onchange="tampilkanPreview(this,'preview')" />
			
            <br><b>Preview Gambar</b><br>
            <img id="preview" src="" alt="" width="200px"/>
          </div>
		</div>
      </div>
    </div>
  </div>
</form>

<?php 
include "../fungsi/imgpreview.php"; // Preview gambar yang akan diupload
?>