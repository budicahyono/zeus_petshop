
<header class="main-header">
  <a href="home.php" class="logo">
    <span class="logo-mini"><b>APL</b></span>
    <span class="logo-lg"><b>ADMIN PANEL</b></span>
  </a>
  <nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
	
      <ul class="nav navbar-nav">
		
		 
		
		
        <li class="dropdown ">
          <a class="dropdown-toggle" >
            <?php include "../fungsi/time.php"; ?>
          </a>
        </li>
        <li class="dropdown user user-menu ">
          <a  href="#" class="active dropdown-toggle" data-toggle="dropdown">
		  <?php if ($sesen_foto == "" ){ ?>
            <img src="../images/admin.png" width="160px" height="160px" class="user-image" alt="User Image"/>
			<?php } else { ?>
            <img src="../images/resize_<?=$sesen_foto?>" width="160px" height="160px" class="user-image" alt="User Image"/>
			<?php }  ?>
            <span class="hidden-xs">
              <?php 
              if ($sesen_usertype == "admin"){echo "Halo, $sesen_nama ";} 
              if ($sesen_usertype == "superadmin"){echo "Halo, $sesen_nama ";} 
              ?>
            </span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
			<?php if ($sesen_foto == "" ){ ?>
              <img src="../images/admin.png" class="img-circle" alt="User Image" />
			<?php } else { ?>
				<img src="../images/resize_<?=$sesen_foto?>" class="img-circle" alt="User Image" />
			<?php }  ?>
			  <p>
              <?php if ($sesen_usertype == "admin" ){echo "$sesen_nama";} ?></p>
              (<?php if($sesen_usertype == 'admin'){echo "ADMIN";}?>)
            </li>
            <li class="user-body">
              <div class="col-xs-6 text-center">
                <a href='ubah_pass.php?id_user=<?php echo md5($sesen_id_user) ?>' class='btn btn-default btn-flat'>Ubah Profil</a>
              </div>
              <div class="col-xs-6 text-center">
                <a href='logout.php' class='btn btn-default btn-flat'>Logout</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>

<!-- Kolom Sebelah Kiri -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
	<?php if ($sesen_foto == "" ){ ?>
      <div class="pull-left image"><img src="../images/admin.png" class="img-circle" style="height:45px;width:50px" alt="User Image"/></div>
	  <?php } else { ?>
      <div class="pull-left image"><img src="../images/resize_<?=$sesen_foto?>"  class="img-circle" style="height:45px;width:50px" alt="User Image"/></div>
	  <?php } ?>
      <div class="pull-left info">
        <p><?php if ($sesen_usertype == "admin"){echo "$sesen_nama";} ?></p>
        <p>(<?php if($sesen_usertype == 'admin'){echo "ADMIN";}?>)</p>
      </div>
    </div>
    
    <?php include "leftbar.php" ?>

  </section>
</aside>