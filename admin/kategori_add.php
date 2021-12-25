<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Tambah Kategori Baru | Administrator</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../images/logo.png" />
    <!-- JS -->
   <?php include "css.php" ?>
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include "header.php"; ?>
      
      <div class="content-wrapper">
        <section class="content-header">
          <h1>Form Entry Kategori Baru</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Kategori</li>
            <li class="active"><a href="kategori_add.php">Entry Kategori Baru</a></li>
          </ol>
        </section>

        <section class="content">
          <?php include "kategori_add_form.php" ?>
        </section>
      </div>
      <?php include "footer.php" ?>
    </div>
<?php include 'js.php'; ?>   
  </body>
</html>