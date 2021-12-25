<?php
    include 'record/record_kategori.php';  
 include 'record/record_produk.php';  

$customer		= mysqli_num_rows(mysqli_query($conn,"SELECT * FROM customer"));
$transaksi		= mysqli_num_rows(mysqli_query($conn,"SELECT * FROM transaksi"));
$pembayaran		= mysqli_num_rows(mysqli_query($conn,"SELECT * FROM bayar"));
$chatting		= mysqli_num_rows(mysqli_query($conn,"SELECT * FROM chatting "));


  ?>
  
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-purple'>
      <div class='inner'><h3><?php echo $kategori ?></h3><p>Kategori</p></div>
      <div class='icon'><i class='fa fa-tag'></i></div>
      <a href='kategori_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  
 
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-red'>
      <div class='inner'><h3><?php echo $produk ?></h3><p>Produk</p></div>
      <div class='icon'><i class='fa fa-cart-plus'></i></div>
      <a href='produk_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  
  
   <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-blue'>
      <div class='inner'><h3><?php echo $customer ?></h3><p>Customer</p></div>
      <div class='icon'><i class='fa fa-users'></i></div>
      <a href='customer.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-yellow'>
      <div class='inner'><h3><?php echo $chatting ?></h3><p>Chatting</p></div>
      <div class='icon'><i class='fa fa-comment'></i></div>
      <a href='chatting.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  
   <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-aqua'>
      <div class='inner'><h3><?php echo $transaksi ?></h3><p>Pesanan</p></div>
      <div class='icon'><i class='fa fa-shopping-cart'></i></div>
      <a href='pesanan.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
   <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-aqua'>
      <div class='inner'><h3><?php echo $pembayaran ?></h3><p>Pembayaran</p></div>
      <div class='icon'><i class='fa fa-dollar'></i></div>
      <a href='pembayaran.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
   
 