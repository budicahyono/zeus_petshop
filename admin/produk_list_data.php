<div class="box">
  <div class="box-body table-responsive padding">
    <table  class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="text-align: center">Judul Barang</th>
          <th style="text-align: center">Gambar</th>
          <th style="text-align: center">Stok</th>
          <th style="text-align: center">Berat</th>
          <th style="text-align: center">Kategori</th>
          <th style="text-align: center">Harga</th>
          <th style="text-align: center">Aksi</th>
        </tr>
      </thead>
      <tbody id="example1">

      <?php
      $sql = "SELECT *
			  FROM produk a 
              LEFT JOIN kategori b on b.id_kat = a.kat 
              ORDER BY a.id_produk ASC";
      $result = mysqli_query($conn, $sql);
      $no = 1;
      if (mysqli_num_rows($result) > 0)
      {
        while ($data = mysqli_fetch_array($result))
        {
          $harga  = number_format($data['harga'], 0, ',', '.');
          $berat  = number_format($data['berat'], 0, ',', '.');
          ?>
          <tr>
            <td style='text-align: left'><?=$data['nama_produk'];?></td>
            <td style='text-align: center'><img src="../images/produk/100px_<?=$data['img'];?>" style="height:100px;"></td>
            <td style='text-align: left'><?=$data['stok'];?> Unit</td>
            <td style='text-align: left'><?=$berat;?> gram</td>
            <td style='text-align: center'><?=$data['judul_kat'];?></td>
            <td style='text-align: center'>Rp <?=$harga;?> </td>
            <td style='text-align: center'>
              <a href="produk_ubah.php?id_produk=<?=$data['id_produk'];?>">
                <button type='submit' class='btn btn-primary'>Ubah</button>
              </a>
              <a href="produk_hapus.php?id_produk=<?=$data['id_produk']?>">
                <button type='submit' class='btn btn-danger' OnClick=\"return confirm('Apakah Anda yakin?');\">Hapus</button>
              </a>
            </td>
          </tr>
		  <?php
          $no++;
        }
      }
      else { ?>
		  <tr><td colspan="10">Belum ada data</td></tr>
		  <?php
		  }
    ?>
    </tbody>
  </table>
  </div>
</div>