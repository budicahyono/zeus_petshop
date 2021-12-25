<?php
$prov 		= $_GET['prov'];
//Get Data Kabupaten / kota
	$curl = curl_init();	
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=".$prov,
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

echo "<option value=''>--Pilih Kabupaten/ Kota--</option>";
	
 for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
	
	echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
}


?>