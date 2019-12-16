<?php
include('server.php');
if (isset($_SESSION['user'])){
	if (isset($_POST['att_pwd'])) {
		$pwd1 = md5($_POST['pwd1']);
		$sql = "update cptv_users set senha = '".$pwd1."' where user like '".$_SESSION['user']."';";
		if (mysqli_query($db, $sql)) {
			header("location: user.php");
		} else{
			array_push($errors, $sql);
		}

	}
	if (isset($_POST['att_foto'])) {
		$img = $_FILES['foto']['name'];
		$uploaddir = '/storage/ssd4/145/8060145/public_html/conceptive/img/';
		$uploadfile = $uploaddir . basename($_SESSION['user']);
		if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile)) {
			header("location: user.php");
		} else {
			echo "<pre>";
			print_r($_FILES);
			echo "</pre>";
		}
	}



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
				
				<?php if (isset($_SESSION['user'])) { ?>
					<div id="img_usr" style="background-image: url('img/<?php echo $_SESSION['user']; ?>');"></div>
				<?php } else { ?>
					<img src="http://rodcordeiro.github.io/shares/img/avatar.png"/>
				<?php } ?>
				<a href="?logoff"><li>logoff</li></a>
				<a href="#"><li><?php echo $_SESSION['user']; ?></li></a>
				<?php if ($_SESSION['usrlvl'] >=2) { echo "<a href='adm/'><li>Admin</li></a>"; } ?>
				<a href="equipe.php"><li>Time</li></a>
				<a href="home.php"><li>Home</li></a>
			</ul>
		</nav>
		<main>
			<section id="content">
				<fieldset>
					<legend>
						Atualizar usuário
					</legend>
					<?php include('errors.php');?>
					<form method="post" action="user.php">
						<input id="pwd1" type="password" name="pwd1" placeholder="Nova senha">
						<input id="pwd2" type="password" name="pwd2" placeholder="Confirme a senha">
						<input type="submit" name="att_pwd" id="att_pwd" value="Atualizar senha" style="display: none;">
					</form> 
					<form enctype="multipart/form-data" method="post" action="user.php">
						<label>Atualizar foto</label><br><br>
						<input type="file" name="foto"><br><br>
						<input type="submit" name="att_foto" value="Atualizar">
					</form>
				</fieldset>

			</section>
		</main>

		<script type="text/javascript">
			setInterval(function(){
				var pwd1 = document.getElementById("pwd1").value;
				var pwd2 = document.getElementById("pwd2").value;
				if (pwd1 != "") {
					if (pwd1 == pwd2) {
						console.log("Iguais");
						document.getElementById("att_pwd").style.display = "block";
					} else{
						console.clear();
						document.getElementById("att_pwd").style.display = "none";
					}
				}
			}, 100)
		</script>


	</body>
	</html>
<?php } else {
	header("location: login.php");
}
?>