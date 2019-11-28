<?php
include('server.php');
if (isset($_SESSION['user'])){
	
	?>
	<html>
	<head>
		<title>HOME | Cordeiros DEV</title>
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

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	</head>
	<body>
		<nav>
			<ul>
				<img src="http://rodcordeiro.github.io/shares/img/avatar.png"/>
				<a href="?logoff"><li>logoff</li></a>
				<a href="user.php"><li><?php echo $_SESSION['user']; ?></li></a>
				<a href="equipe.php"><li>Time</li></a>
				<a href="#"><li>Home</li></a>

			</ul>
		</nav>
		<main>
			<div class="content">
				<?php foreach ($_SESSION['acessos'] as $key => $value) {
					echo "<a href='projetos/$value/'>$value</a><br>";
				}
				?>
			</div>
		</main>


	</body>
	</html>
<?php } else {
	header("location: login.php");
}
?>