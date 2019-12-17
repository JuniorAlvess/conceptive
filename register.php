<?php include('server.php'); ?>
<html>
	<head>
		<title>Registrar | Cordeiro's DEV</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		<!-- FAVICON -->
		<link rel="apple-touch-icon" sizes="57x57" href="https://rodcordeiro.github.io/shares/favicons/favicon-rc/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="https://rodcordeiro.github.io/shares/favicons/favicon-rc/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="https://rodcordeiro.github.io/shares/favicons/favicon-rc/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="https://rodcordeiro.github.io/shares/favicons/favicon-rc/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="https://rodcordeiro.github.io/shares/favicons/favicon-rc/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="https://rodcordeiro.github.io/shares/favicons/favicon-rc/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="https://rodcordeiro.github.io/shares/favicons/favicon-rc/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="https://rodcordeiro.github.io/shares/favicons/favicon-rc/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="https://rodcordeiro.github.io/shares/favicons/favicon-rc/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="https://rodcordeiro.github.io/shares/favicons/favicon-rc/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="https://rodcordeiro.github.io/shares/favicons/favicon-rc/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="https://rodcordeiro.github.io/shares/favicons/favicon-rc/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="https://rodcordeiro.github.io/shares/favicons/favicon-rc/favicon-16x16.png">
		<link rel="manifest" href="https://rodcordeiro.github.io/shares/favicons/favicon-rc/manifest.json">
		<meta name="msapplication-TileColor" content="#CCCCCC">
		<meta name="msapplication-TileImage" content="https://rodcordeiro.github.io/shares/favicons/favicon-rc/ms-icon-144x144.png">

		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		

	</head>
	<body>
		<nav>
			<ul>
				<?php if (isset($_SESSION['user'])) { ?>
					<div id="img_usr" style="background-image: url('img/<?php echo $_SESSION['user']; ?>');"></div>
				<?php } else { ?>
					<img src="http://rodcordeiro.github.io/shares/img/avatar.png"/>
				<?php } ?>
				<?php if (isset($_SESSION['user'])): ?>
					<a href="home.php"><li>Home</li></a>
				<?php endif ?>
				
				<a href="login.php"><li>Login</li></a>
				<a href="index.php"><li>Sobre nós</li></a>
			</ul>
		</nav>
		<main>
			<div class="form">
				<form action="register.php" method="post">
					<?php include('errors.php');?>
					<p class="error" style="text-align: center;"></p>
					<label for="uid" class="input">
						<label class="placeholder" for="uid">UserID </label>
						<input type="text" name="uid" id="uid" >
					</label>
					<label for="nome" class="input">
						<label class="placeholder" for="nome">Nome completo</label>
						<input type="text" name="nome" id="nome" >
					</label>
					<label for="email" class="input">
						<label class="placeholder" for="email">Email</label>
						<input type="email" name="email" id="email" >
					</label>
					<label for="passwd_1" class="input">
						<label class="placeholder" for="passwd_1">Password</label>
						<input type="password" name="passwd_1" id="passwd_1" >
					</label>
					<label for="passwd_2" class="input">
						<label class="placeholder" for="passwd_2">Confirm password</label>
						<input type="password" name="passwd_2" id="passwd_2" >
					</label>
					
					
					<p class="error" style="text-align: center;"></p>
					<input type="submit" name="register" value="Register">
					<span class="footer">Already a member? <a href="login.php">Login.</a></span>
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
	