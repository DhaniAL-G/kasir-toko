<?php
	@ob_start();
	session_start();
	#include 'config.php';
	// condition when form submitted
	if(isset($_POST['proses'])){
		require 'config.php';
		// get data from form
		$user = strip_tags($_POST['user']);
		$pass = strip_tags($_POST['pass']);
		// encrypt password with md5
		$pass = md5($pass);
		// query inner join between table member and login where user = $user and pass = $pass  
		$sql = "select member.*, login.user, login.pass
				from member inner join login on member.id_member = login.id_member
				where user =? and pass = ?";
		// prepare query 
		$row = $config->prepare($sql);
		// bind parameter 
		$row -> execute(array($user,$pass));
		// get result of query
		$jum = $row -> rowCount();
		// condition login when result > 0
		if($jum > 0){
			$hasil = $row -> fetch();
			$_SESSION['admin'] = $hasil;
			header('location:index.php');
			// echo '<script>alert("Login Sukses");window.location="index.php"</script>';
		}else{
			echo '<script>alert("Login Gagal");history.go(-1);</script>';
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style="background-image :url(assets/img/pic/index.jpg);
  			background-repeat: no-repeat;
            color:#fff;">

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page" style="padding-top:3pc;">
	  	<div class="container">
		      <form class="form-login" method="POST">
		        <h2 class="form-login-heading">Login</h2>
		        <div class="login-wrap">
		            <input type="text" class="form-control" name="user" placeholder="User ID" autofocus>
		            <br>
		            <input type="password" class="form-control" name="pass" placeholder="Password">
		            <br>
		            <button class="btn btn-primary btn-block" name="proses" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		        </div>
		      </form>	  	
	  	
	  	</div>
	  </div>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>

