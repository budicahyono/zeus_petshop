<?php 
session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session

include '../fungsi/tgl_indo.php';         // Panggil fungsi merubah tanggal menjadi format seperti 2 Mei 2015

$id  = $_GET['id'];

$sql_customer  = mysqli_query($conn,"SELECT * FROM chatting_detail WHERE id_chatting =$id order by id_chatting_detail desc");
								
								while ($row = mysqli_fetch_array($sql_customer)) { 
								if ($row['level'] == "customer") {
									$user = "customer";
									$css = "";
								} else {
									$user = "admin";
									$css = "red";
								}
								
								?>
								<div class="col-md-12 dialog <?php echo $css ?>">
									
									<div class="header">

										<span><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;<?php echo $row['username'] ?></span>
										
										<span><i class="glyphicon glyphicon-tags"></i>&nbsp;&nbsp;<?php echo $user ?>
										</span>
										<?php if ($row['level'] == "admin") { ?>
										<div class="form-group pull-right" style="padding-left:10px">
										<?php } else { ?>
										<div class="form-group pull-right" style="padding-right:10px;padding-left:10px">
										<?php } ?>
										<a class="btn btn-warning btn-xs"  href="chatting_hapus.php?id=<?php echo  $row['id_chatting_detail'] ?>&chat=<?=$id?>"   onclick="return confirm('Apakah Anda yakin?')"><i class="glyphicon glyphicon-remove"></i>&nbsp;&nbsp;Hapus
										</a>
										</div>
									</div>

									<div class="isi">
										<?php echo $row['isi'] ?>
									</div>
								</div>
								<?php }
								?>
								