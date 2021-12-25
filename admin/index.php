<?php session_start();
include '../config.php';
if(isset($_SESSION['username']))
{
	header("location:home.php");
}
else{}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login | Zeus Petshop</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="template/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="template/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="template/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="../images/logo.png" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div align="center">
        <h1 class="login-logo"><b>Admin Area</b></h1>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <div class="user image"  align="center"><img  style="width:100px" src="../images/admin.png"><br/><br/></div>
        <form action="login.php" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="username" required/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <button type="submit" name="submit" class="btn btn-success btn-block btn-flat">Login</button>
			  <a href="../"  class="btn btn-primary btn-block btn-flat">Kembali</a>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="template/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="template/css/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="template/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>