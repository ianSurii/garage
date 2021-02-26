<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title> AUTOMOBILE CARE</title>
	<link rel="stylesheet" type="text/css" href="home.css">
	<link href="https://fonts.googleapis.com/css?family=Flamenco" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<header>
		<p class="istockphoto-180712113-1024x1024.jpg"></p>
		<nav>
			<div class="row clearfix">
				<img src="" class="logo">
				<ul class="main-nav animated slideInDown">
					<li><a href="register.php"> Register </a></li>
				<li><a href="aboutus.html">Products</a></li>
				<li><a href="signup.html">Sign Up</a></li>

				</ul>

			</div>
		</nav>
     
		<div class="main-content-header">
		<h1>  WELCOME TO <span>AUTOMOBILE CARE</span>.<br /> QUICK FIX ON THE GO! </h1>
		</div>
	</header>
</body>
</html>
<?php
    unset($_SESSION["error"]);
?>