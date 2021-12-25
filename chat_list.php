<?php
session_start();  
include 'config.php';
include 'fungsi/base_url.php';
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public

$sql = "SELECT * FROM chatting where status_chat = 1 AND username = '$sesen_username' ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0){
	$hasil = mysqli_fetch_array($result);
	$id_chatting = $hasil['id_chatting'];
	
	$chat_query = "SELECT * FROM chatting_detail WHERE id_chatting = '$id_chatting' ";
	$run_query = mysqli_query($conn,$chat_query);
	
	while($row = mysqli_fetch_array($run_query)) { 
	
	  ?>
	<div class="row" style="margin:0">
	<div class="<?=$row['level']?> sub-dialog">
	<p><b><?=$row['username']?></b></p>
	<?=$row['isi']?>
	</div>
	</div>
	
	
	
	
	
	
	<?php }} ?>