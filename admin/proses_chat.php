<?php 
include '../config.php';
include '../fungsi/base_url.php';
  $isi   	= $_POST['isi'];
  $level 	= $_POST['level'];
  $username = $_POST['username'];
  $id_chatting = $_POST['id_chatting'];
  
  $sql = "SELECT * FROM chatting where id_chatting = '$id_chatting' and status_chat = 1  order by id_chatting desc";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0){
		$hasil = mysqli_fetch_array($result);
		$id_chatting = $hasil['id_chatting'];	
 	 	
 // Proses insert data chatting
 $create = "INSERT INTO chatting_detail ( id_chatting_detail,
                                   id_chatting,
                                   username,
                                   level,
                                   isi)
                          VALUES (null,
                                  '$id_chatting',
                                  '$username',
                                  '$level',
                                  '$isi')";
								  
		if (mysqli_query($conn, $create)) 
		  {
			echo "Chat Berhasil di kirim";
		  } 
		  else 
		  {
			echo "Error updating record: " . mysqli_error($conn);
		  }								  
								  
	} else {
		echo "error";
	}
?>