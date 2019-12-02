<?php
include('../../server.php');
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

	</head>
	<body>
		<nav>
			<ul>
				<?php if (isset($_SESSION['user'])) { ?>
					<img src="../../img/<?php echo $_SESSION['user']; ?>"/>
				<?php } else { ?>
					<img src="http://rodcordeiro.github.io/shares/img/avatar.png"/>
				<?php } ?>
				<a href="?logoff"><li>logoff</li></a>
				<a href="../../user.php"><li><?php echo $_SESSION['user']; ?></li></a>
				<?php if ($_SESSION['usrlvl'] >=2) { echo "<a href='../../adm/'><li>Admin</li></a>"; } ?>
				<a href="../../equipe.php"><li>Time</li></a>
				<a href="../../home.php"><li>Home</li></a>

			</ul>
		</nav>
		<main>
		    <div class="content">
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
								<input type="submit" name="task_fanatic" value="Adicionar">
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
								<?php while($row = mysqli_fetch_array($tasks_fanatic)){ ?>
									<tr>
									<td><?php echo $row['cod']; ?></td>
									<td><?php echo $row['titulo']; ?></td>
									<td><?php echo $row['prioridade']; ?></td>
									<?php if ($_SESSION['usrlvl'] >=2) {
									 echo "<td><a href='?task=".$row['cod']."'><i class='fa fa-trash-o'></i></td></a>";
									}else{
										echo "<td><i class='fa fa-ban'></i></td>";
									}
									?>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</section>
				<section id="nota">
					<header>
						<fieldset id="nova_nota">
							<legend>
								Nova nota
							</legend>
							<form action="index.php" method="post">
								<input type="text" name="titulo" placeholder="Titulo da nota">
								<br><br>
								<textarea name="nota" placeholder="Insira aqui a anotação..."></textarea>
								<br>
								<input type="submit" name="adicionar_fanatic" value="Adicionar">
							</form>
						</fieldset>
					</header>
					<div id="notas">
						<?php while ($row = mysqli_fetch_array($notas_fanatic)) { ?>
							<article>
								<legend>
									<?php echo $row['data_criacao']; ?> | <?php echo $row['titulo']; ?><span class="analista"><?php echo $row['user']; ?></span>
									<?php if (($row['user'] == $_SESSION['nome']) || $_SESSION['usrlvl'] >=2) {
										echo "<a href='?delete=".$row['id']."' class='action'><i class='fa fa-trash-o'></i></a>";
									} ?>
								</legend>
								<p><?php echo $row['anotacao']; ?></p>
							</article>
						<?php } ?>
					</div>
				</section>

			</div>

		</main>


	</body>
	</html>
<?php } else {
	header("location: ../../login.php");
}
?>