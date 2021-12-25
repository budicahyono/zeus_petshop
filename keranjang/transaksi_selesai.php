
    <?php include 'navbar.php'; 
	$faktur = $_SESSION['faktur'];
	?>
	
    <!-- Page Content -->
	
	<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12 ">
          <h3 class="kotak"><span class="glyphicon glyphicon-shopping-cart kotak-icon"></span> Transaksi Selesai</h3>
        </div>
      </div>
	  
	  <div class="row text-center" style="width:900px;margin:auto">
<div class="col-sm-12 hero-feature">
        <div class="thumbnail">
		<div class="title">
		 <a class="disabled">
            <h4>Invoice Transaksi No.#<?php echo $faktur ?></h4>
		</a>	
		</div>
	
   
              <?php include 'transaksi_selesai_data.php'; ?>
           
        
      </div>  
      </div>  
      </div>  
      </div>  
      
      <hr/>

      <?php include 'footer.php'; ?>

    </div>
    
    <!-- Memanggil file JS -->
    <script src="<?php echo $base_url ?>template/js/jquery.js"></script>
    <script src="<?php echo $base_url ?>template/js/bootstrap.min.js"></script>
  </body>
</html>