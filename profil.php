<?php 
include 'navbar.php'; 
$id_customer = $_SESSION['id_customer'];
$sql_customer  = mysqli_query($conn,"SELECT * FROM customer WHERE id_customer =$id_customer");

$hasil        = mysqli_fetch_array($sql_customer);

$nama         = $hasil['nama'];
$email     	= $hasil['email'];
$username     = $hasil['username'];
$alamat       = $hasil['alamat'];
$telepon       = $hasil['telepon'];
$kota       	= $hasil['kota'];
$kopos       	= $hasil['kopos'];
$provinsi       	= $hasil['provinsi'];
$password       	= $hasil['password'];
$status       	= $hasil['status'];
$curl = curl_init();
 
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
	
	$data = json_decode($response, true);
			$city = $data['rajaongkir']['results']['city_name'];
			$prov = $data['rajaongkir']['results']['province'];
			$province_id = $data['rajaongkir']['results']['province_id'];
			$kopos = $data['rajaongkir']['results']['postal_code'];
			
			
//Get Data provinsi
	$curl2 = curl_init();	
	curl_setopt_array($curl2, array(
	  CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
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
	
	$response2 = curl_exec($curl2);
	$err2 = curl_error($curl2);

	curl_close($curl2);
	
	$data2 = json_decode($response2, true);			
			
?>
    <!-- Awal Konten Utama -->
	<div class="container-fluid" style="margin-bottom:100px" >
	 <div class="row">
        <div class="col-lg-12 ">
          <h3 class="kotak"><span class="glyphicon glyphicon-user kotak-icon"></span> Profil Customer</h3>
        </div>
      </div>
	
	<div class="row text-center" style="max-width:1000px;margin:auto;">
	<div class="col-sm-12 hero-feature" style="padding:0">
			<div class="thumbnail">
			<div class="title">
			 <a class="disabled">
				<h4>Silahkan edit profil anda</h4>
			</a>	
			  </div>
          
           




<form method="post" id="form-register" class="clearfix" action="edit_profil.php">
  
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body text-left">
          <div class="form-group row">
            <div class="col-xs-12"><label>Nama Lengkap</label>
              <input value="<?=$nama;?>" class="form-control" name="nama" type="text" id="nama" size="30" required/>
              <input value="<?=$id_customer;?>" class="form-control" name="id_customer" type="hidden" id="nama" size="30" required/>
            </div>
			 </div>
			 
			<div class="form-group row">
            <div class="col-xs-12"><label>Username</label>
              <input value="<?=$username;?>"  class="form-control" name="username" type="text" id="username" size="30" required/>
            </div>
            </div>
			
			<div class="form-group row">
            <div class="col-xs-12"><label>No. Telepon</label>
              <input value="<?=$telepon;?>" class="form-control" name="telepon" type="text" id="telepon" size="30" required/>
            </div>
            </div>
         
			<div class="form-group row">
            <div class="col-xs-12"><label>Email</label>
              <input value="<?=$email;?>" class="form-control" name="email" type="text" id="email" size="30" required/>
            </div>
            </div>
			
			<div class="form-group row">
            <div class="col-xs-12"><label>Password</label>
              <input value="<?=$password;?>" class="form-control" name="password" type="password" id="password" size="30" required/>
            </div>
            </div>
			
			<div class="form-group row">
			<div class="col-xs-12"><label>Alamat</label>
				<textarea class="form-control" name="alamat" id="alamat" required><?=$alamat;?></textarea>
			</div>
			</div>
		  
          <div class="form-group"><label>Provinsi</label>
            <select name="prov" id="prov" class="form-control" required>
            <option value="">--Pilih Provinsi--</option>
              <?php
            for ($i=0; $i < count($data2['rajaongkir']['results']); $i++) { ?>
			<option value="<?=$data2['rajaongkir']['results'][$i]['province_id'];?>" 
			<?php if ($data2['rajaongkir']['results'][$i]['province'] == $prov) { echo "selected";} ?> >
			<?=$data2['rajaongkir']['results'][$i]['province']?>
			</option>
			<?php } ?>
            </select>
          </div>
		  <?php
		  
		 
//Get Data Kabupaten / kota
	$curl3 = curl_init();	
	curl_setopt_array($curl3, array(
	  CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=".$province_id,
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
	
	$response3 = curl_exec($curl3);
	$err3 = curl_error($curl3);

	curl_close($curl3);
	
	$data3 = json_decode($response3, true); ?>
          <div class="form-group"><label>Kabupaten/ Kota</label>
            <select name="kot" id="kot" class="form-control" required>
              <option value="">--Pilih Kabupaten/ Kota--</option>
			  <?php for ($i=0; $i < count($data3['rajaongkir']['results']); $i++) {  ?>
				<option value="<?=$data3['rajaongkir']['results'][$i]['city_id'];?>" 
				<?php if ($data3['rajaongkir']['results'][$i]['city_name'] == $city) { echo "selected";} ?> >
				<?=$data3['rajaongkir']['results'][$i]['city_name']?>
				</option>
			  <?php } ?>  
            </select>
          </div>
          <div class="form-group"><label>Kode Pos</label>
		  <span id="kopos">
            <input value="<?=$kopos;?>" readonly class="form-control" name="kopos" type="text" size="30"/>
		  </span>	
          </div>
		  
		  
       <div class="form-group">
          <button type="submit" name="submit" class="btn btn-success">Submit</button>
          <button type="reset" name="reset" class="btn btn-danger">Reset</button>
        </div>
		
        </div>
      </div>
    </div>
</form>
              
              
              
            </div>
          </div>
        </div>

        
        
      </div>
	
	
	
    <!-- Akhir Konten Utama -->
	 <!-- Awal Footer -->
      <?php include 'footer_nochat.php'; ?>
	
    <script type="text/javascript">
    var htmlobjek;
    $(document).ready(function(){

      //apabila terjadi event onchange terhadap object <select id=propinsi>
      $("#prov").change(function(){
        var prov = $("#prov").val();
        $.ajax({
            url: "fungsi/ambilkota.php",
            data: "prov="+prov,
            cache: false,
            success: function(msg){
                //jika data sukses diambil dari server kita tampilkan
                //di <select id=kota>
                $("#kot").html(msg);
            }
        });
      });
      
      $("#kot").change(function(){
        var kot = $("#kot").val();
        $.ajax({
            url: "fungsi/ambilkopos.php",
            data: "kot="+kot,
            cache: false,
            success: function(msg){
                $("#kopos").html(msg);
            }
        });
      });
    });
    
	
    </script>
   
    <style type="text/css">
      label.error {
      color: red; 
      padding-left: .5em;
      font-weight: normal;
      }
    </style>
  </body>
</html>