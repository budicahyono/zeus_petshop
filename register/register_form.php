<div class="row text-center" style="max-width:500px;margin:auto">
<div class="col-sm-12 hero-feature" style="padding:0">
        <div class="thumbnail">
		<div class="title">
		 <a class="disabled">
            <h4>Register Customer</h4>
		</a>	
		  </div>
<?php 
//Get Data provinsi
	$curl = curl_init();	
	curl_setopt_array($curl, array(
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
	
	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);
	
	$data = json_decode($response, true);
?>




<form method="post" id="form-register" class="clearfix" action="register/send.php">
  
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body text-left">
          <div class="form-group row">
            <div class="col-xs-12"><label>Nama Lengkap</label>
              <input class="form-control" name="nama" type="text" id="nama" size="30" required/>
            </div>
			 </div>
			 
			<div class="form-group row">
            <div class="col-xs-12"><label>Username</label>
              <input class="form-control" name="username" type="text" id="username" size="30" required/>
            </div>
            </div>
			
			<div class="form-group row">
            <div class="col-xs-12"><label>No. Telepon</label>
              <input class="form-control" name="telepon" type="text" id="telepon" size="30" required/>
            </div>
            </div>
         
			<div class="form-group row">
            <div class="col-xs-12"><label>Email</label>
              <input class="form-control" name="email" type="text" id="email" size="30" required/>
            </div>
            </div>
			
			<div class="form-group row">
            <div class="col-xs-12"><label>Password</label>
              <input class="form-control" name="password" type="password" id="password" size="30" required/>
            </div>
            </div>
			
			<div class="form-group row">
			<div class="col-xs-12"><label>Alamat</label>
				<textarea class="form-control" name="alamat" id="alamat" required></textarea>
			</div>
			</div>
		  
          <div class="form-group"><label>Provinsi</label>
            <select name="prov" id="prov" class="form-control" required>
            <option value="">--Pilih Provinsi--</option>
              <?php
            for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
				echo "<option value='".$data['rajaongkir']['results'][$i]['province_id']."'>".$data['rajaongkir']['results'][$i]['province']."</option>";
			}
              
              ?>
            </select>
          </div>
          <div class="form-group"><label>Kabupaten/ Kota</label>
            <select name="kot" id="kot" class="form-control" required>
              <option value="">--Pilih Kabupaten/ Kota--</option>
            </select>
          </div>
          <div class="form-group"><label>Kode Pos</label>
		  <span id="kopos">
            <input readonly class="form-control" name="kopos" type="text" size="30"/>
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