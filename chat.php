<div  class="chat">


<div  class="chat-box" id="open"><span  class='glyphicon glyphicon-comment' aria-hidden='true'></span></div>

<div style="display:none" id="chat" class="chat-shadow">
<div class="heading"><h4>Chatting</h4></div>
<div  class="chat-dialog">
<div id="error"></div>
	<div class="content">
	<?php if(isset($_SESSION['username'])) { ?>
	
	<div class="text-center question"><b>Ada yang bisa kami bantu <?=$sesen_username?>?</b></div>
	<div class="form-group input-center">
	 <form onsubmit="return false" id="send">
	
              <textarea class="form-control" name="isi" id="isi" type="text"  size="30" style="width:270px" required/></textarea>
              <input class="form-control" name="level" id="level" type="hidden"  size="30" style="width:270px" value="customer" required/>
              <input class="form-control" name="username" id="username" type="hidden"  size="30" style="width:270px" value="<?=$sesen_username?>" required/>
			  <p style="margin-top:-5px"></p>
			  <button  id="submit" class="btn btn-success">Kirim</button>
			  <button id="tutup"  class="btn btn-danger">Tutup</button>
	</form>		 
	

    </div>
	<div class="roll" id="get_chat">
	
	</div>	
	
	
	<?php } else { ?>
	<div class="text-center question"><b>Sebelum chatting harap login terlebih dahulu</b></div>
	<div class="form-group text-center">
	<a href="<?php echo $base_url ?>login.html"  class="btn btn-success">Login</a>
	<button id="tutup"  class="btn btn-danger">Tutup</button>
	 </div>
	 
	<div class="text-center question"><b>Jika belum terdaftar akunnya harap register terlebih dahulu</b></div>
	<div class="form-group text-center">
	<a href="register.html"  class="btn btn-warning">Register</a>
	 </div>
	<?php } ?>
           
	</div>
</div>
</div>

</div>