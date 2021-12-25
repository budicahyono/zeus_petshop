<?php 
include "faktur.php"; 

$cek    = "SELECT * FROM transaksi WHERE username = '$sesen_username' AND status = '0' ";
$hasil  = mysqli_query($conn,$cek);
$data   = mysqli_fetch_array($hasil);

$n      = $_POST['n'];

if(isset($_POST['save']))
{
  if(mysqli_num_rows($hasil) == 0)
  {
    echo "<script>alert('Transaksi tidak ditemukan');location.replace('keranjang.html')</script>";
  }
    $faktur = $data['notransaksi'];

      $id_produk  = $_POST['id'.$i];

      $sql        = "UPDATE transaksi SET  status        	= '1'
									WHERE notransaksi   	= '$faktur' 
									AND   username      	= '$sesen_username'";
      $check      = mysqli_query($conn,$sql);
      
	if($check) 
	{
	  header("location:transaksi_selesai.html");
	} 
	else 
	{
	  echo "Error updating record: " . mysqli_error($conn);
	}
			
			
			
      
}
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya!');location.replace('keranjang.html')</script>";
  } 
?>