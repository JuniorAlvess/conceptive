<?php
 include('../server.php');
if (isset($_SESSION['user'])){

if (isset($_POST['new_project'])) {
/* PARA CRIAR PASTA */
$pasta = $_POST['projeto'];
mkdir('../projetos/'.$pasta.'/', 0777, true);

// delete from cptv_projetos where projeto like 'cordeiro';delete from cptv_acessos where acessos like 'cordeiro';
mysqli_query($db,"insert into cptv_projetos(projeto, status,data_criacao) values('$pasta','aberto',current_date());");
mysqli_query($db,"insert into cptv_acessos(user,acessos) values('rodcordeiro','$pasta');");

//INSERIR AQUI

$consulta_acessos = mysqli_query($db,"select * from cptv_acessos where user like '".$_SESSION['user']."';");
$_SESSION['acessos'] = array();
while($row = mysqli_fetch_array($consulta_acessos)){
	array_push($_SESSION['acessos'], $row['acessos']);
}
ksort($_SESSION['acessos']);
/* 
$notas_conceptive = mysqli_query($db, "SELECT * FROM cptv_anotacoes where data_finalizacao IS NULL and projeto like 'conceptive'");
if(isset($_POST['adicionar_conceptive'])){
	$user = $_SESSION['nome'];
	$titulo = $_POST['titulo'];
	$nota = $_POST['nota'];
	$sql = "insert into cptv_anotacoes (data_criacao,user,titulo,anotacao,data_finalizacao,projeto) values 
	(curdate(),'$user','$titulo','$nota',NULL,'conceptive');";
	mysqli_query($db, $sql);
	$notify =mysqli_query($db,"select email from cptv_users;");
	while ($row = mysqli_fetch_array($notify)) {
		$email_servidor = "rodrigomendoncca@gmail.com";
		$para = $row['email'];
		$de = $_SESSION['email'];
		$mensagem = "<h3>Nova nota adicionada!!</h3>
		<p> O ".$_SESSION['nome']." acabou de inserir uma nova nota:<br> <a target='_blank' href='rodrigocordeiro.com.br".$_SERVER['PHP_SELF']."'>$titulo</a></p>
		";
		$assunto = "Nova nota adicionada";
		enviaEmail($de, $assunto, $mensagem, $para, $email_servidor);
	}
	header('location: index.php');
}
$tasks_conceptive = mysqli_query($db,"select * from cptv_task where status is null and projeto like 'conceptive' order by prioridade desc");
if (isset($_POST['task_conceptive'])) {
	$titulo = $_POST['titulo'];
	$lvl = $_POST['prioridade'];
	$sql = "insert into cptv_task(titulo,prioridade,projeto) values ('$titulo','$lvl','conceptive');";
	mysqli_query($db,$sql);
	$notify =mysqli_query($db,"select email from cptv_users;");
	while ($row = mysqli_fetch_array($notify)) {
		$email_servidor = "rodrigomendoncca@gmail.com";
		$para = $row['email'];
		$de = $_SESSION['email'];
		$mensagem = "<h3>Nova tarefa adicionada!!</h3>
		<p> O ".$_SESSION['nome']." acabou de inserir uma nova tarefa:<br> <a target='_blank' href='rodrigocordeiro.com.br".$_SERVER['PHP_SELF']."'>$titulo</a></p>
		";
		$assunto = "Nova tarefa adicionada";
		enviaEmail($de, $assunto, $mensagem, $para, $email_servidor);
	}
	header("location: index.php");
}
*/
}
?>
<html>
<head>
	<title>HOME | Cordeiros DEV</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
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
					<div id="img_usr" style="background-image: url('../img/<?php echo $_SESSION['user']; ?>');"></div>
				<?php } else { ?>
					<img src="http://rodcordeiro.github.io/shares/img/avatar.png"/>
				<?php } ?>
	        <a href="?logoff"><li>logoff</li></a>
	        <a href="../user.php"><li><?php echo $_SESSION['user']; ?></li></a>
	        <a href="../home.php"><li>Home</li></a>
			

		</ul>
	</nav>
	<main>
		<section id="content">
				
				<fieldset>
					<legend>
						Gerenciamento
					</legend>

					<h3>Atualizar nivel de usuário</h3>
				<form action="index.php" method="post">
					<?php 
					$lista_usuarios = "select * from cptv_users;";
					$qls = mysqli_query($db, $qls);
					?>
					<select name='usuario'>
						<?php while($row = mysqli_fetch_array($qls)){ ?>
						<option value="<?php echo $row['user'] ?>"><?php echo $row['nome'] ?></option>
					<?php } ?>
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
				<form action="index.php" method="post">
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
			<form method="post" action="index.php"> 
				<input type="text" name="projeto" placeholder="Novo do projeto">
				<input type="submit" name="new_project" value="Criar">
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
	header("location: ../login.php");
}
		?>