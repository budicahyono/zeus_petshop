<?php 
session_start();  
include 'config.php';
include 'fungsi/base_url.php';
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public

  $isi   	= $_POST['isi'];
  $level 	= $_POST['level'];
  $username = $_POST['username'];
  
  
 $sql = "SELECT * FROM chatting where username = '$username' and status_chat = 1  order by id_chatting desc";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0){
		$hasil = mysqli_fetch_array($result);
		$id_chatting = $hasil['id_chatting'];
	} else {	
	$id_chatting = rand(100000,999999);
		// Proses insert data chatting
		$chatting = "INSERT INTO chatting ( id_chatting,
                                   username,
                                   status_chat)
                          VALUES ('$id_chatting',
                                  '$username',
                                  '1')";
		mysqli_query($conn, $chatting);
	}
			
$chatting_detail = "INSERT INTO chatting_detail ( id_chatting_detail,
                                   id_chatting,
								   username,
								   level,
								   isi)
                          VALUES (null,
								  '$id_chatting',
                                  '$username',
                                  '$level',
                                  '$isi')";
		
		
		if (mysqli_query($conn, $chatting_detail)) 
		  {
			echo "<div class='alert alert-success melayang1' id='alert'>
						<a href='#' class='close' id='tutup' >&times;</a>
						<b>Chatting berhasil dikirim!!</b>
				</div>";
			exit(); 
		  } 
		  else 
		  {
			echo "Error updating record: " . mysqli_error($conn);
		  }								  
	/*							  
	} else { 
	echo "<div class='alert alert-danger melayang1'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Chatting telah ditutup!!</b>
				</div>";
		exit(); 
	
	} */
?>