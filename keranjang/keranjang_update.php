<?php session_start(); 
include "../config.php"; 
include "../faktur.php"; 
include "../fungsi/base_url.php"; 
include "../fungsi/cek_session_public.php"; 
include "../fungsi/cek_login_public.php"; 

$cek    = "SELECT * FROM transaksi WHERE username = '$sesen_username' AND status = '0' ";
$hasil  = mysqli_query($conn,$cek);
$data   = mysqli_fetch_array($hasil);



if(isset($_POST['update']))
{
  if(mysqli_num_rows($hasil) == 0)
  {
    echo "<script>alert('Transaksi tidak ditemukan');location.replace('../keranjang.html')</script>";
  }
    $faktur = $data['notransaksi'];

   
      $id_produk  = $_POST['id'];	

      $cari2        = "SELECT * FROM produk WHERE id_produk = '$id_produk' ";
      $hasil2       = mysqli_query($conn,$cari2);
      $data2        = mysqli_fetch_array($hasil2);
	  
	  $harga = $data2['harga'];
      $stok         = $data2['stok'];
	  
	  $cari3        = "SELECT * FROM transaksi_detail WHERE id_produk = '$id_produk' and username = '$sesen_username' and 		
						notransaksi = '$faktur' ";
      $hasil3       = mysqli_query($conn,$cari3);
      $data3        = mysqli_fetch_array($hasil3);
	  
	  
      
      

      if(mysqli_num_rows($hasil2) > 0)
      {
         $jmlubah  = $_POST['jumlah'];
        $beratnew = $jmlubah * $data2['berat'];
        $totubah  = $jmlubah * $harga;
		
		$jmlawal =  $data3['jumlah']  + $data2['stok'];
	    if($beratnew >= 30000)
        {
          echo "<script>alert('Maaf Berat Barang tidak boleh melebihi 30000 gram');location.replace('../keranjang.html')</script>";
		 
		
        } else {
			
        if($jmlubah > $jmlawal)
        {
             echo "<script>alert('Jumlah Barang tidak boleh lebih besar dari stok');location.replace('../keranjang.html')</script>";
		
		 
		} 
		else  if($jmlubah == 0)
        {
         echo "<script>alert('Jumlah Barang tidak boleh 0');location.replace('../keranjang.html')</script>";
		 
        }
		
		
		
		else  if($jmlubah <= $jmlawal)
        {
            $query = mysqli_query($conn,"UPDATE transaksi_detail SET  jumlah        = '$jmlubah', 
																	  jumlah_berat  = '$beratnew', 
																 	  subtotal      = '$totubah' 
																WHERE notransaksi   = '$faktur' 
																AND   username      = '$sesen_username'
																AND   id_produk     = '$id_produk' ");
			
			
			
				$jmlakhir = $jmlubah - $data3['jumlah'];
				$stok_kurang = $data2['stok'] - $jmlakhir;
				$query_produk = "update produk SET stok = '$stok_kurang'
										WHERE id_produk = '$id_produk'";		
			
		  
		  
            if(mysqli_query($conn, $query_produk)) 
            {
			  echo "<script>alert('Jumlah Barang berhasil di edit');location.replace('../keranjang.html')</script>";
            } 
            else 
            {
              echo "Error updating record: " . mysqli_error($conn);
            }
			
			
			
		}
	    }
      }
        else
        {
          echo "<script>alert('Barang yang ingin Anda beli tidak ditemukan');location.replace('index.html')</script>";
        }
   
}
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya!');location.replace('../keranjang.html')</script>";
  } 
?>