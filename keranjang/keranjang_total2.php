<?php
$sql_total_berat 		= mysqli_query($conn,"SELECT sum(jumlah_berat) AS jumlah_berat FROM transaksi_detail 
						          INNER JOIN produk ON produk.id_produk = transaksi_detail.id_produk 
						          INNER JOIN transaksi ON transaksi.notransaksi = transaksi_detail.notransaksi 
						          WHERE transaksi_detail.username = '$sesen_username'
						          AND transaksi.notransaksi = '$faktur' 
					          	AND transaksi.status >='1'  ");
$data2 							= mysqli_fetch_array($sql_total_berat);
$jumlah_berat 			= $data2['jumlah_berat'];
$jumlah_berat_all 	= $jumlah_berat;