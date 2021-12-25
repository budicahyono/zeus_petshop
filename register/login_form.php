
    <?php include 'navbar.php'; ?>

    <!-- Awal Konten Utama -->
	<div class="container-fluid" style="margin-bottom:100px" >
	 <div class="row">
        <div class="col-lg-12 ">
          <h3 class="kotak"><span class="glyphicon glyphicon-list-alt kotak-icon"></span> Login</h3>
        </div>
      </div>
	
	<div class="row text-center" style="max-width:500px;margin:auto;">
	<div class="col-sm-12 hero-feature" style="padding:0">
			<div class="thumbnail">
			<div class="title">
			 <a class="disabled">
				<h4>Login Customer</h4>
			</a>	
			  </div>
          
              <form method="post" class="clearfix text-left" id="form-login" action="register/login.php">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-body">
          <div class="form-group"><label>Username</label>
            <input class="form-control" name="username" type="text" id="username" size="30" required/>
          </div>
          <div class="form-group"><label>Password</label>
            <input class="form-control" name="password" type="password" id="password" size="30" required/>
          </div>
       
	    <div class="form-group">
          <button type="submit" name="submit" class="btn btn-success">Submit</button>
          <button type="reset" name="reset" class="btn btn-danger">Reset</button>
        </div>
        </div>
      </div><!-- /.box -->
      <!-- left column -->
    </div>
</form>
              
              
              
            </div>
          </div>
        </div>

        
        
      </div>
	
	
	
    <!-- Akhir Konten Utama -->
	 <!-- Awal Footer -->
      <?php include 'footer.php'; ?>
      <!-- Akhir Footer -->
    
    <script type="text/javascript">
    var htmlobjek;
   
    
	//hapus dari sini...
	$(document).ready(function() 
    {
     
      $('#form-login').validate(
      {
        rules:  
        {
          username: 
          {
            minlength: 5
          },
          pwd: 
          {
            required: true,
            minlength:5,
          },
        },
        messages: 
        {
          username:
          {
            required: "* Username harus diisi",
            minlength: "* Username harus diisi minimal 5 huruf"
          },
          pwd:
          {
            required: "* Password harus diisi",
            minlength: "* Password harus diisi minimal 5 huruf"
          },
        },
      });
	  //sampe sini
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