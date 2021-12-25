
<?php
  // batas threshold 75%
  $threshold = 50;
  // jumlah maksimum artikel terkait yg ditampilkan 10 buah
  $maksArtikel = 10;

  
  // membaca judul artikel dari ID tertentu (ID artikel acuan)
  // judul ini nanti akan dicek kemiripannya dengan artikel yang lain
  $query = "SELECT * FROM produk WHERE judul_seo = '$id_produk'";
  $hasil = mysqli_query($conn,$query);
  $data  = mysqli_fetch_array($hasil);
  $nama_produk = $data['nama_produk'];

  // membaca semua data artikel selain ID artikel acuan
  $query = "SELECT * FROM produk WHERE id_produk <> '$id_produk'";
  $hasil = mysqli_query($conn,$query);
  $jumlah = mysqli_num_rows($hasil);
  while ($data = mysqli_fetch_array($hasil))
  {
    // cek similaritas judul artikel acuan dengan judul artikel lainnya
    similar_text($nama_produk, $data['nama_produk'], $percent);
    if ($percent >= $threshold)
    {
      // jika prosentase kemiripan judul di atas threshold
      if (count($jumlah) <= $maksArtikel)
      {
        // jika jumlah artikel belum sampai batas maksimum, tambahkan ke dalam array
		if ($id_produk_asli != $data['id_produk']) {
        ?>
		
        <div class='col-md-3 col-sm-6'>
          <div class="thumbnail">
           <div class="title text-center">
			<a href="<?php echo $base_url ?>produk/<?php echo $data['judul_seo']; ?>.html" >
            <h4><?php echo $data['nama_produk']; ?></h4>
          </a>
		 </div> 
            <center><img alt="<?=$data['nama_produk']?>" src="<?="$base_url"."images/produk/$data[img]"?>" style="width:80px;height:130px" class="img-responsive"/></center>
            <div class='caption' align='center'>
              <a href='<?="$base_url"."beli/$data[id_produk]"?>' class='btn btn-primary'>Beli</a> 
              <a href='<?="$base_url"."produk/$data[judul_seo].html"?>' class='btn btn-default'>Detail</a>
            </div>
          </div>
        </div>
       
		<?php
		}
      }
    }
  } 

  // jika array listartikel tidak kosong, tampilkan listnya
  // jika kosong, maka tampilkan 'tidak ada artikel terkait'
  if ($jumlah == 0)
  { 
	?>

<ul><p>Tidak ada produk terkait</p></ul>

<?php

  }


?>