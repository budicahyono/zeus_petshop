<?php
$id_kat     = mysqli_real_escape_string($conn,$_GET['id_kat']);
$sql        = "SELECT * FROM kategori WHERE id_kat = '$id_kat' ";
$result     = mysqli_query($conn, $sql);
$data       = mysqli_fetch_array($result);
?>

<form action="kategori_ubah_proses.php" method="post">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box">
        <div class="box-body">
          <input name="id_kat" type="hidden" id="id_kat" value="<?php echo $data['id_kat'] ?>">
          <div class="form-group"><label>Judul Kategori</label>
            <input type="text" class="form-control" name="judul_kat" id="judul_kat" size="30" value="<?php echo $data['judul_kat'] ?>" required/>
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" name="submit" class="btn btn-success">Submit</button>
          <button type="reset" name="reset" class="btn btn-danger">Reset</button>
        </div>
      </div><!-- /.box -->
      <!-- left column -->
    </div>
  </div>
</form>