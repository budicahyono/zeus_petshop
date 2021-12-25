
    <?php include 'navbar.php'; ?>
	<div class="container-fluid" style="margin-bottom:100px">
      
      <div class="row">
        <div class="col-lg-12 ">
          <h3 class="kotak"><span class="glyphicon glyphicon-shopping-cart kotak-icon"></span> Keranjang Belanja</h3>
        </div>
      </div>
    
              <?php include 'keranjang_data.php'; ?>
            
       <hr/>
        
      </div>  
      
      

      <?php include 'footer.php'; ?>

    
    
    <!-- Membuat fungsi input pada qty barang hanya boleh diisi dengan angka -->
    <script>
    function isNumberKey(evt)
    {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
      return true;
    }
    </script>
   