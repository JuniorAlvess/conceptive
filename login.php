<?php 
include('server.php'); 
?>
	<html>
	<head>
		<title>Login | Cordeiros DEV</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		<!-- FAVICON -->
		<link rel="apple-touch-icon" sizes="57x57" href="https://rodcordeiro.github.io/shares/my-favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="https://rodcordeiro.github.io/shares/my-favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="https://rodcordeiro.github.io/shares/my-favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="https://rodcordeiro.github.io/shares/my-favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="https://rodcordeiro.github.io/shares/my-favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="https://rodcordeiro.github.io/shares/my-favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="https://rodcordeiro.github.io/shares/my-favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="https://rodcordeiro.github.io/shares/my-favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="https://rodcordeiro.github.io/shares/my-favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="https://rodcordeiro.github.io/shares/my-favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="https://rodcordeiro.github.io/shares/my-favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="https://rodcordeiro.github.io/shares/my-favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="https://rodcordeiro.github.io/shares/my-favicon/favicon-16x16.png">
		<link rel="manifest" href="https://rodcordeiro.github.io/shares/my-favicon/manifest.json">
		<meta name="msapplication-TileColor" content="#CCCCCC">
		<meta name="msapplication-TileImage" content="https://rodcordeiro.github.io/shares/my-favicon/ms-icon-144x144.png">

		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

	</head>
	<body>
		<nav>
			<ul>
				<img src="https://rodcordeiro.github.io/shares/img/logo_branco.png">
				<?php if (isset($_SESSION['user'])): ?>
					<a href="home.php"><li>Home</li></a>
				<?php endif ?>
				<a href="register.php"><li>Sign up</li></a>
				<a href="index.php"><li>Sobre nós</li></a>
			</ul>
		</nav>
		<main>
			<div class="form">
				<form action="login.php" method="post">
					<?php include('errors.php');?>
					<p class="error" style="text-align: center;"></p>
					<label for="email" class="input">
						<label class="placeholder" for="user">User</label>
						<input type="text" name="user" id="user">
					</label>
					<p class="error" style="text-align: center;"></p>
					<label for="pswd" class="input">
						<label class="placeholder" for="pswd">Password</label>
						<input type="password" name="pswd" id="pswd">
					</label>
					<p class="error" style="text-align: center;"></p>
					<input type="submit" name="login" value="Login">
					<span class="footer">Don't have an account? <a href="register.php">Register here</a></span>
				</form>
			</div>
		</main>

		<script>
			$(document).ready(function(){
				$(".form form > .input > input").each(function(index) {
					if($.trim($(this).val()).length != 0) {
						$(this).parent().addClass("focus");
					}
				})
			})
			$(".form form > .input > input").on("focus blur", function(){
				if($.trim($(this).val()).length == 0) {
					$(this).parent().toggleClass("focus");
				}
			})
		</script>
	</body>
	</html>
