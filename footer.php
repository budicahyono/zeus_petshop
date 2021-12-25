<footer  class=" merdeka" style="bottom:-10px;width:100%">
  <div class="container-fluid">
      
        <p style=""><b>Zeus Petshop</b> <br>Alamat: Jalan Reremi Palapa, Manokwari, Papua Barat |
		<b>No. WA: <?=$no_hp_admin?> (<?=$nama_admin?>)</b></p>  
		
     
  </div>
</footer>

<!-- Memanggil file JS -->
    <script src="<?php echo $base_url ?>template/js/jquery.js"></script>
    <script src="<?php echo $base_url ?>template/js/bootstrap.min.js"></script>
    
	


	<script>
$(document).ready(function(){
    $("#open").click(function(){
        $("#chat").show();
        $("#open").hide();
		
    });
    $("#tutup").click(function(){
        $("#chat").hide();
		$("#open").show();
    });
});

var base_url =  "localhost/zeus_petshop";
	
	
	

	 $("#submit").click(function(){
		 $.ajax({
			method:	"POST",
			url: '<?php echo $base_url ?>proses_chat.php',
			data	:$("#send").serialize(),
			success	:function(data){
					$("#error").html(data);
					$("#alert").delay(1000).fadeOut();
					$("#isi").val("");
					chat_list();
					
			}	
		})
	})
	
	chat_list();
	window.setInterval(chat_list, 1000);
	
	//brand() is a funtion fetching brand record from database whenever page is load
	function chat_list(){
		$.ajax({
			url	:	'<?php echo $base_url ?>chat_list.php',
			method:	"GET",
			success	:	function(data){
				$("#get_chat").html(data);
				var elem = document.getElementById('get_chat');
				elem.scrollTop = elem.scrollHeight;
			}
		})
	}
	
</script>






