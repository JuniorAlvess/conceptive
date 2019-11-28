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
	        <a href="#"><li><?php echo $_SESSION['user']; ?></li></a>
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
					<form>
						
					<input type="" name="" placeholder="Nova senha">
					<input type="" name="" placeholder="Confirme a senha">
					<input type="submit" name="" value="Atualizar senha">
					</form> 
					<form>
						<label>Atualizar foto</label><br>
						<input type="file" name=""><br>
						<input type="submit" name="" value="Atualizar">
					</form>
				</fieldset>
				<fieldset>
					<legend>
						Gerenciamento
					</legend>

					<h3>Atualizar nivel de usuário</h3>
				<form action="user.php" method="post">
					<select name='usuario'>
						<option>user1</option>
						<option>user1</option>
						<option>user1</option>
					</select>
					<select name="lvl">
						<option>1</option>
						<option>2</option>
						<option>3</option>
					</select>
					<input type="submit" name="atualizar_lvl" value="Atualizar">
				</form>
			<hr>
			<h3>Liberar acessos</h3>
				<form action="user.php" method="post">
					<select name='usuario'>
						<option>user1</option>
						<option>user1</option>
						<option>user1</option>
					</select>
					<select name="projeto">
						<option>1</option>
						<option>2</option>
						<option>3</option>
					</select>
					<input type="submit" name="libproj" value="Atualizar">
				</form>
			<hr>
			<h3>Gerenciar projetos</h3>
			<form>
				<input type="text" name="" placeholder="Novo do projeto">
				<input type="submit" name="" value="Criar">
			</form>
			<form>
				<select>
					<option>Projeto1</option>
					<option>Projeto1</option>
					<option>Projeto1</option>
				</select>
				<input type="submit" name="" value="Encerrar">
			</form>
				</fieldset>
		</section>
	</main>

	


</body>
</html>
<?php } else {
	header("location: login.php");
}
		?>