


<!-- jQuery 2.1.4 -->
<script src="template/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- jQuery UI 1.11.2 -->
<script src="template/plugins/jQueryUI/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="template/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
<!-- Slimscroll -->
<script src="template/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<!-- FastClick -->

	<script src="template/dist/js/app.min.js" type="text/javascript"></script>

 <script src="template/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="template/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- Skrip Datatables -->
    <script type="text/javascript">
    $(function () {
    $("#example1").dataTable();
    $('#example2').dataTable({
      "bPaginate": true,
      "bLengthChange": false,
      "bFilter": true,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false,
    });
    });
    </script>
	
	<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();   
	});
</script>
 <script>
var base_url =  "localhost/zeus_petshop";
	 $("#submit").click(function(){
		 $.ajax({
			method:	"POST",
			url: 'proses_chat.php',
			data	:$("#send").serialize(),
			success	:function(data){
				chat_list();
				$("#isi").val("");
				
			}	
		})
	})
	chat_list();
	window.setInterval(chat_list, 1000);
	//brand() is a funtion fetching brand record from database whenever page is load
	function chat_list(){
		<?php if (isset($_GET['id'])) {$id = $_GET['id'];} else {$id = 0;	} ?>
		$.ajax({
			url	:	'chat_list.php?id=<?=$id?>',
			method:	"GET",
			success	:	function(data){
				$("#get_chat").html(data);
				
			}
		})
	}
	
</script>