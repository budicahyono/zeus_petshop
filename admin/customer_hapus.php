<?php session_start();
include '../config.php';                // Panggil koneksi ke database
include '../fungsi/cek_login.php';      // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';    // Panggil fungsi cek session
include '../fungsi/tgl_indo.php';        // Panggil data setting

if(isset($_GET['id']))
{
  $id_customer    = htmlspecialchars($_GET['id']);


         // proses delete customer
		$query_customer = mysqli_query($conn, "DELETE FROM customer WHERE id_customer = '$id_customer'");
		
		  
        if($query_customer) 
        {
       
          echo "<script>location.replace('customer.php')</script>";
        } 
          else 
          {
            echo "Error updating record: " . mysqli_error($conn);
          }
      
}

?>