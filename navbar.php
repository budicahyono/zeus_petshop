<?php 
$sql_admin 		= mysqli_query($conn,"SELECT *  FROM user WHERE id_user = '1' ");
$hasil_admin 							= mysqli_fetch_array($sql_admin);


// isi API
$nama_admin 			= $hasil_admin['nama'];
$no_rek_admin 			= $hasil_admin['no_rek'];
$bank_admin 			= $hasil_admin['bank'];
$no_hp_admin 			= $hasil_admin['no_hp'];


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?=$title?> | Zeus Petshop</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Zeus Petshop"/>
    <meta name="keywords" content="Zeus Petshop"/>
    <meta name="author" content="Zeus Petshop"/>    
    <!-- CSS Bootstrap -->
    <link href="<?php echo $base_url ?>template/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>template/css/custom.css" rel="stylesheet">
    <!-- Favicon -->
    <link href="<?php echo $base_url ?>images/logo.png" rel="shortcut icon"/>
	
	<style>
	.file-upload input.upload {
		position: absolute;
		top: 0;
		right: 0;
		margin: 0;
		padding: 0;
		font-size: 20px;
		cursor: pointer;
		opacity: 0;
		filter: alpha(opacity=0);
	}
	.file-upload {
		position: relative;
		overflow: hidden;
	}
	</style>
	
  </head>
  <body>
  
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" id="logo" href="<?php echo $base_url ?>" ><img id="img"  style="display:inline;width:50px;margin-top:-13px" src="<?php echo $base_url ?>images/logo.png"> <span id="span"  style="top:-3px;position:relative;">&nbsp;&nbsp; Zeus Petshop</span></a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <li class="<?php if ($nav == "index" or $nav == "" ) echo "active"; ?>">
          <a href='<?php echo $base_url ?>index.html'>
            <span class='glyphicon glyphicon-home' aria-hidden='true'></span> Home
          </a>
        </li>
        <li class="<?php if ($nav == "katalog" ) echo "active"; ?>">
          <a href='<?php echo $base_url ?>katalog.html'>
            <span class='glyphicon glyphicon-book' aria-hidden='true'></span> Katalog
          </a>
        </li>
		 <?php 
      if(isset($_SESSION['username']))
      { 
		?>
        <li class="<?php if ($nav == "keranjang" ) echo "active"; ?>">
          <a href='<?php echo $base_url ?>keranjang.html'>
            <span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span> Keranjang
          </a>
        </li>
        <li class="<?php if ($nav == "konfirmasi" ) echo "active"; ?>">
          <a href='<?php echo $base_url ?>konfirmasi.html'>
            <span class='glyphicon glyphicon-bullhorn' aria-hidden='true'></span> Konfirmasi
         
		  <?php 
		  if (isset($_SESSION['username'])) {
		  $query_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM transaksi WHERE username = '$sesen_username' AND status = '1' "));
		  if ($query_count > 0) {  ?>
		  <span class="badge bg-red"><?php echo $query_count ?></span>
		  <?php
			  }
		  }  
			   ?>
		    </a>
        </li>
	  <?php } ?>	
        <li class="<?php if ($nav == "register" ) echo "active"; ?>"><a href='<?=$base_url?>register.html'><span class='glyphicon glyphicon-user' aria-hidden='true'></span>  Register</a></li>
		<li class="<?php if ($nav == "login" ) echo "active"; ?>"><a href='<?=$base_url?>login.html'><span class='glyphicon glyphicon-lock' aria-hidden='true'></span>   Login</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
	    <?php 
      if(isset($_SESSION['username']))
      { 
		?>
        <li class='dropdown'>
          <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
            <span class='glyphicon glyphicon-user' aria-hidden='true'></span> <span id="nama">Hai, <?=$sesen_username?> <span class='caret'></span> <span>
          </a>
          <ul class='dropdown-menu'>
			 <li>
              <a href='<?=$base_url?>profil.html'>
                <span class='glyphicon glyphicon-user' aria-hidden='true'></span> Profil
              </a>
            </li>
		   <li>
              <a href='<?=$base_url?>logout'>
                <span class='glyphicon glyphicon-log-out' aria-hidden='true'></span> Logout
              </a>
            </li>
          </ul>
        </li>
		<?php
      } else {
      ?>
	   <li class=""><a href='<?=$base_url?>admin'><span class='glyphicon glyphicon-lock' aria-hidden='true'></span>  Admin</a></li>
	  <?php } ?>
      </ul>
    </div>
  </div>
</nav>


<?php 
if ($nav == "index" or $nav == "katalog" or $nav == "kategori" or $nav == "produk") {

include "chat.php";

}
?>














