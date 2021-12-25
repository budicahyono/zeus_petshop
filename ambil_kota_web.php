<?php

$kot 		= 272; //manokwari
//Get Data Kabupaten / kota
	$curl = curl_init();	
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://api.rajaongkir.com/starter/city?id=".$kot,
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
	
	$data = json_decode($response, true);

	$kota_asal = $data['rajaongkir']['results']['city_id'];
	 




?>
