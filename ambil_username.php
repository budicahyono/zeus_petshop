<?php
 $sesen_username   = $_SESSION['username'];
$ambil_username 		= mysqli_query($conn,"SELECT * FROM customer
						          WHERE username = '$sesen_username'");
$data_customer 							= mysqli_fetch_array($ambil_username);
$nama 			= $data_customer['nama'];
$telepon 			= $data_customer['telepon'];
$alamat 			= $data_customer['alamat'];
$kopos 			= $data_customer['kopos'];
$provinsi 			= $data_customer['provinsi'];
$kota 			= $data_customer['kota'];

//Get Data Kabupaten / kota
	$curl = curl_init();	
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://api.rajaongkir.com/starter/city?id=".$kota,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
	    "key: 050eb79e0ce195656d97a083143baff5"
	  ),
	));
	
	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);
	
	$data_user = json_decode($response, true);




