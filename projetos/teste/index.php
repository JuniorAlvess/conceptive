<?php 
include('../../server.php');
$sql_consulta = "SELECT * FROM cptv_anotacoes where data_finalizacao IS NULL and projeto like 'teste';";
$notas_teste = mysqli_query($"."db,$"."sql_consulta);

if(isset($_POST['adicionar_teste'])){
	$user = $_SESSION['nome'];
	$titulo = $_POST['titulo'];
	$nota = $_POST['nota'];
	$sql = "insert into cptv_anotacoes (data_criacao,user,titulo,anotacao,data_finalizacao,projeto) values 	(curdate(),'','','',NULL,'teste');";
mysqli_query($db, $sql);
$notify =mysqli_query($db,"select distinct u.email from cptv_acessos a inner join cptv_users u on a.user=u.user where a.acessos like 'teste'";);
while ($row = mysqli_fetch_array($notify)) {
	$email_servidor = "rodrigomendoncca@gmail.com";
	$para = $row['email'];
	$de = $_SESSION['email'];
	$mensagem = '<h3>Nova nota adicionada!!</h3>
		<p> O '.$_SESSION['nome'].' acabou de inserir uma nova nota:<br> <a target='_blank' href='rodrigocordeiro.com.br'.$_SERVER['PHP_SELF'].'>$titulo</a></p>
		';
	$assunto = 'Nova nota adicionada';
	enviaEmail($de, $assunto, $mensagem, $para, $email_servidor);
	}
	header('location: index.php');
}
$tasks_conceptive = mysqli_query($db,"select * from cptv_task where status is null and projeto like 'teste' order by prioridade desc");
if (isset($_POST['task_teste'])) {
	$titulo = $_POST['titulo'];
	$lvl = $_POST['prioridade'];
	$sql = "insert into cptv_task(titulo,prioridade,projeto) values ('','','teste');";
mysqli_query($db, $sql);
$notify =mysqli_query($db,"select distinct u.email from cptv_acessos a inner join cptv_users u on a.user=u.user where a.acessos like 'teste'";);
while ($row = mysqli_fetch_array($notify)) {
	$email_servidor = "rodrigomendoncca@gmail.com";
	$para = $row['email'];
	$de = $_SESSION['email'];
	 = '<h3>Nova tarefa adicionada!!</h3>
		<p> O '.$_SESSION['nome'].' acabou de inserir uma nova tarefa:<br> <a target='_blank' href='rodrigocordeiro.com.br'.$_SERVER['PHP_SELF'].'>$titulo</a></p>
		';
	enviaEmail($de, $assunto, $mensagem, $para, $email_servidor);
	}
	header('location: index.php');
}

if (isset($_SESSION['user'])){
	?>
	<html>
	<head>
		<title>HOME | Cordeiros DEV</title>
		<link rel="stylesheet" type="text/css" href="../../style.css">
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

<script src="../../Toast.js"></script>
<link rel="stylesheet" href="../../Toast.css">


	</head>
	<body>
		<nav>
			<ul>
<?php if (isset($_SESSION['user'])) { ?>
	<div id='img_usr' style="background-image: url(../../img/<?php echo $_SESSION['user']; ?>');"></div>
<?php } else { ?>
					<img src="http://rodcordeiro.github.io/shares/img/avatar.png"/>
				<?php } ?>
				<a href="?logoff"><li>logoff</li></a>
				<a href="../../user.php"><li><?php echo
				 $_SESSION['user']; ?></li></a>
				<?php if ($_SESSION['usrlvl'] >=2)				{ 
	echo "<a href=../../adm/'><li>Admin</li></a>";
 } ?>
				<a href="../../equipe.php"><li>Time</li></a>
				<a href="../../home.php"><li>Home</li></a>
			</ul>
		</nav>
		<main>
		    <div class="content">
		    	<h3>teste</h3>
				<section id="checklist">
					<header>
						<fieldset id="nova_nota">
							<legend>
								Lista de tarefas
							</legend>
							<form action="index.php" method="post">
								<input type="text" name="titulo" placeholder="Descrição da nota">
								<br><br>
								<select name="prioridade">
									<option value="0">Selecione a prioridade</option>
									<option>1</option>
									<option>2</option>
									<option>3</option>
								</select>
								<br><br>
								<input type="submit" name="task_teste" value="Adicionar">
							</form>
						</fieldset>
					</header>
					<div id="notas">
						<table>
							<thead>
								<tr>
									<th>COD</th>
									<th>TAREFA</th>
									<th>PRIORIDADE</th>
									<th>Ações</th>
								</tr>
							</thead>
							<tbody>
							<?php while($row = mysqli_fetch_array($tasks_teste)){ ?>
									<tr>									<td><?php echo $row['cod']; ?></td>
									<td><?php echo $row['titulo']; ?></td>
									<td><?php echo $row['prioridade']; ?></td>
									<?php if ($_SESSION['usrlvl'] >=2) {									 echo "<td><a href=?task=".$row['cod'].'><i class='fa fa-trash-o'></i></td></a>
									}else{										echo "<td><i class='fa fa-ban'></i></td>";
									}
									?>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>

<?php 
include('../../server.php');
$sql_consulta = "SELECT * FROM cptv_anotacoes where data_finalizacao IS NULL and projeto like 'teste';";
$notas_teste = mysqli_query($"."db,$"."sql_consulta);

if(isset($_POST['adicionar_teste'])){
	$user = $_SESSION['nome'];
	$titulo = $_POST['titulo'];
	$nota = $_POST['nota'];
	$sql = "insert into cptv_anotacoes (data_criacao,user,titulo,anotacao,data_finalizacao,projeto) values 	(curdate(),'','','',NULL,'teste');";
mysqli_query($db, $sql);
$notify =mysqli_query($db,"select distinct u.email from cptv_acessos a inner join cptv_users u on a.user=u.user where a.acessos like 'teste'";);
while ($row = mysqli_fetch_array($notify)) {
	$email_servidor = "rodrigomendoncca@gmail.com";
	$para = $row['email'];
	$de = $_SESSION['email'];
	$mensagem = '<h3>Nova nota adicionada!!</h3>
		<p> O '.$_SESSION['nome'].' acabou de inserir uma nova nota:<br> <a target='_blank' href='rodrigocordeiro.com.br'.$_SERVER['PHP_SELF'].'>$titulo</a></p>
		';
	$assunto = 'Nova nota adicionada';
	enviaEmail($de, $assunto, $mensagem, $para, $email_servidor);
	}
	header('location: index.php');
}
$tasks_conceptive = mysqli_query($db,"select * from cptv_task where status is null and projeto like 'teste' order by prioridade desc");
if (isset($_POST['task_teste'])) {
	$titulo = $_POST['titulo'];
	$lvl = $_POST['prioridade'];
	$sql = "insert into cptv_task(titulo,prioridade,projeto) values ('','','teste');";
mysqli_query($db, $sql);
$notify =mysqli_query($db,"select distinct u.email from cptv_acessos a inner join cptv_users u on a.user=u.user where a.acessos like 'teste'";);
while ($row = mysqli_fetch_array($notify)) {
	$email_servidor = "rodrigomendoncca@gmail.com";
	$para = $row['email'];
	$de = $_SESSION['email'];
	 = '<h3>Nova tarefa adicionada!!</h3>
		<p> O '.$_SESSION['nome'].' acabou de inserir uma nova tarefa:<br> <a target='_blank' href='rodrigocordeiro.com.br'.$_SERVER['PHP_SELF'].'>$titulo</a></p>
		';
	enviaEmail($de, $assunto, $mensagem, $para, $email_servidor);
	}
	header('location: index.php');
}

if (isset($_SESSION['user'])){
	?>
	<html>
	<head>
		<title>HOME | Cordeiros DEV</title>
		<link rel="stylesheet" type="text/css" href="../../style.css">
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

<script src="../../Toast.js"></script>
<link rel="stylesheet" href="../../Toast.css">


	</head>
	<body>
		<nav>
			<ul>
<?php if (isset($_SESSION['user'])) { ?>
	<div id='img_usr' style="background-image: url(../../img/<?php echo $_SESSION['user']; ?>');"></div>
<?php } else { ?>
					<img src="http://rodcordeiro.github.io/shares/img/avatar.png"/>
				<?php } ?>
				<a href="?logoff"><li>logoff</li></a>
				<a href="../../user.php"><li><?php echo
				 $_SESSION['user']; ?></li></a>
				<?php if ($_SESSION['usrlvl'] >=2)				{ 
	echo "<a href=../../adm/'><li>Admin</li></a>";
 } ?>
				<a href="../../equipe.php"><li>Time</li></a>
				<a href="../../home.php"><li>Home</li></a>
			</ul>
		</nav>
		<main>
		    <div class="content">
		    	<h3>teste</h3>
				<section id="checklist">
					<header>
						<fieldset id="nova_nota">
							<legend>
								Lista de tarefas
							</legend>
							<form action="index.php" method="post">
								<input type="text" name="titulo" placeholder="Descrição da nota">
								<br><br>
								<select name="prioridade">
									<option value="0">Selecione a prioridade</option>
									<option>1</option>
									<option>2</option>
									<option>3</option>
								</select>
								<br><br>
								<input type="submit" name="task_teste" value="Adicionar">
							</form>
						</fieldset>
					</header>
					<div id="notas">
						<table>
							<thead>
								<tr>
									<th>COD</th>
									<th>TAREFA</th>
									<th>PRIORIDADE</th>
									<th>Ações</th>
								</tr>
							</thead>
							<tbody>
							<?php while($row = mysqli_fetch_array($tasks_teste)){ ?>
									<tr>									<td><?php echo $row['cod']; ?></td>
									<td><?php echo $row['titulo']; ?></td>
									<td><?php echo $row['prioridade']; ?></td>
									<?php if ($_SESSION['usrlvl'] >=2) {
echo "<td><a href=?task=".$row['cod'].'><i class='fa fa-trash-o'></i></td></a>
									}else{
echo "<td><i class='fa fa-ban'></i></td>";
									}
									?>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>

