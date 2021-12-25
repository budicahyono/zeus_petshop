
    <?php 
	
	if(isset($_SESSION['username']))
{
  // Jika user telah login dan ingin masuk ke halaman ini kembali, maka akan diarahkan ke halaman index/ home
  die ("<script>alert('Anda telah login'); location.replace('$base_url')</script>");
}

	include 'navbar.php'; ?>

    <!-- Awal Konten Utama -->
    <div class="container-fluid" >
	 <div class="row">
        <div class="col-lg-12 ">
          <h3 class="kotak"><span class="glyphicon glyphicon-list-alt kotak-icon"></span> Register</h3>
        </div>
      </div>
	
     
              <?php include "register/register_form.php" ?>
          

    
    </div>
      <!-- Awal Footer -->
      <?php include 'footer_nochat.php'; ?>
      <!-- Akhir Footer -->

    </div>
    <!-- Akhir Konten Utama -->
    
    <!-- Memanggil JS -->
    <script src="<?php echo $base_url ?>template/js/jquery.js"></script>
    <script src="<?php echo $base_url ?>template/js/bootstrap.min.js"></script>
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