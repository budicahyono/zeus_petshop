<?php


$cek = "SELECT sum(subtotal) AS subtotal FROM transaksi_detail 
          INNER JOIN produk ON produk.id_produk = transaksi_detail.id_produk
          INNER JOIN transaksi ON transaksi.notransaksi = transaksi_detail.notransaksi 
          WHERE transaksi.notransaksi = '$faktur' 
	          AND transaksi_detail.username = '$sesen_username' 
	          AND transaksi.status >='1'";
$hasil  = mysqli_query($conn,$cek);
$data1   = mysqli_fetch_array($hasil);

$subtotal_all = $data1['subtotal'];
?>