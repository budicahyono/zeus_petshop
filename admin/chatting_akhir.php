<?php 
include '../config.php';
include '../fungsi/base_url.php';

$id  = $_GET['id'];
  	
 // Proses insert data chatting
 $updating = "UPDATE chatting SET status_chat = '0' WHERE id_chatting = '$id' ";
								  
		if (mysqli_query($conn, $updating)) 
		  {
			echo "<script>alert('Chatting berhasil dinonaktifkan! Klik ok untuk melanjutkan');location.replace('chatting.php')</script>";
		  } 
		  else 
		  {
			echo "Error updating record: " . mysqli_error($conn);
		  }								  
								  
  
?>