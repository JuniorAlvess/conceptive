<?php 

$timeout = 14400; // Tempo da sessao em segundos
// Verifica se existe o parametro timeout, ou seja, se a sessão foi iniciada
if(isset($_SESSION['timeout'])) {
    // Calcula o tempo que ja se passou desde a criação da sessao
	$duracao = time() - (int) $_SESSION['timeout'];  
    // Verifica se ja expirou o tempo da sessao
	if($duracao > $timeout) {
        // Destroi a sessao e cria uma nova
		session_destroy();
		session_start();
	}
} else {
// Define o timeout com o horario atual
	session_start();
	$_SESSION['timeout'] = time();
}
$uid = "";
$nome = "";
$email = "";
$errors = array();
// Conectar ao banco de dados:
//A conexão ao banco de dados é feita no conexao.php
include('conexao.php');
//If Logoff is set
if (isset($_GET['logoff'])) {
	session_destroy();
	header('location:http://www.rodrigocordeiro.com.br/conceptive/login.php');
}

function enviaEmail($de, $assunto, $mensagem, $para, $email_servidor) {
			$headers = "From: $email_servidor\r\n" .
			"Reply-To: $de\r\n" .
			"X-Mailer: PHP/" . phpversion() . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			mail($para, $assunto, nl2br($mensagem), $headers);
		}

//If Login is clicked:
if (isset($_POST['login'])) {
	$uid= preg_replace('/[^[:alnum:]_]/', '',$_POST['user']);
	$senha = $_POST['pswd'];
	$pswd = md5($senha);
	$log ="select * from cptv_users where user='".$uid."' and senha='".$pswd."';";
	$r = mysqli_query($db, $log);

	if (mysqli_fetch_row($r)) {
		$_SESSION['user'] = $uid;
		$usuario =mysqli_query($db,"select * from cptv_users where user='".$uid."';");

		while ($row = mysqli_fetch_array($usuario)) {
			$_SESSION['nome'] = $row['nome'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['usrlvl'] = $row['lvl'];
			$_SESSION['pwd'] = $senha;
		}

		$consulta_acessos = mysqli_query($db,"select * from cptv_acessos where user like '".$_SESSION['user']."';");
		
		$_SESSION['acessos'] = array();
		while($row = mysqli_fetch_array($consulta_acessos)){
			array_push($_SESSION['acessos'], $row['acessos']);
		}
		ksort($_SESSION['acessos']);
		header('location: home.php');
	} else {
		array_push($errors, "Erooou!! Veja se o usuário ou senha estão corretos.");
	}

}


	//If Register is clicked:
if(isset($_POST['register'])){
	$uid = $_POST['uid'];
	$nome =$_POST['nome'];
	$email =$_POST['email'];
	$passwd_1 =$_POST['passwd_1'];
	$passwd_2 =$_POST['passwd_2'];

		//Garantir que os campos estejam preenchidos:
	if(empty($uid)) {
		array_push($errors, "Preenche o usuário por favor.");
	}
	if(empty($nome)) {
		array_push($errors, "Desculpa mas eu preciso saber seu nome para saber quem tu és.");
	}
	if(empty($email)) {
		array_push($errors, "Não vou mandar newsletter, prometo. Mas preciso do seu e-mail para caso queira resetar sua senha ou o FBI esteja atrás de você por exemplo.");
	}
	if(empty($passwd_1)) {
		array_push($errors, "Você precisa de senha.");
	}
	if($passwd_1 != $passwd_2){
		array_push($errors, "É... Você errou as senhas. Não estão iguais.");
	}

		//Salvar na DB se não possuir erros
	if(count($errors) == 0) {
		$passwd = md5($passwd_1);
		$sql = "INSERT INTO cptv_users (user, nome, email, senha, lvl) VALUES ('$uid', '$nome', '$email', '$passwd', 1)";
		if(mysqli_query($db,$sql)){
			$email_servidor = "rodrigomendoncca@gmail.com";
			$para = $email;
			$de = "rodrigomendoncca@gmail.com";
			$mensagem = "<h2>$nome, seja bem vindo(a) ao nosso blog!!!</h2>
			<p> 
			A meta deste blog é manter o acompanhamento dos projetos (tanto da faculdade quanto pessoais) de modo que tenhamos uma lista de tarefas e um bloco de anotações para manter informações e acompanhamentos relevantes ao projeto.
			</p>
			";
			$assunto = "Seja bem vindo(a) a Conceptive!";
			enviaEmail($de, $assunto, $mensagem, $para, $email_servidor);
			
			$email_servidor = "rodrigomendoncca@gmail.com";
			$para = "rodrigomendoncca@gmail.com";
			$de = $email;
			$mensagem = "<h3>Novo usuário!!</h3>
			<p> O ".$nome." acaba de cadastrar-se ao conceptive, dê as boas vindas, verifique o nível dele e se merece digievolução!</p>
			";
			$assunto = "Novo usuário no blog";
			enviaEmail($de, $assunto, $mensagem, $para, $email_servidor);

			mysqli_query($db, "insert into cptv_acessos(user,acessos) values('$uid','conceptive');");
			header('location:login.php');
		} else {
			array_push($errors, "Vish, rolou não. Não deu pra salvar seu contato agora mas volta depois?");
		}

	}
}

	//Notas

$notas_conceptive = mysqli_query($db, "SELECT * FROM cptv_anotacoes where data_finalizacao IS NULL and projeto like 'conceptive'");
$notas_devblog = mysqli_query($db, "SELECT * FROM cptv_anotacoes where data_finalizacao IS NULL and projeto like 'devblog'");
$notas_fanatic = mysqli_query($db, "SELECT * FROM cptv_anotacoes where data_finalizacao IS NULL and projeto like 'fanaticsports'");


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
if(isset($_POST['adicionar_devblog'])){
	$user = $_SESSION['nome'];
	$titulo = $_POST['titulo'];
	$nota = $_POST['nota'];
	$sql = "insert into cptv_anotacoes (data_criacao,user,titulo,anotacao,data_finalizacao,projeto) values 
	(curdate(),'$user','$titulo','$nota',NULL,'devblog');";
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
if(isset($_POST['adicionar_fanatic'])){
	$user = $_SESSION['nome'];
	$titulo = $_POST['titulo'];
	$nota = $_POST['nota'];
	$sql = "insert into cptv_anotacoes (data_criacao,user,titulo,anotacao,data_finalizacao,projeto) values 
	(curdate(),'$user','$titulo','$nota',NULL,'fanaticsports');";
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
if (isset($_GET['delete'])) {
	$id = $_GET['delete'];
	$sql = "update cptv_anotacoes set data_finalizacao = now() where id like $id;";
	mysqli_query($db, $sql);
	header('location: index.php');
}


//TASKS
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

$tasks_devblog = mysqli_query($db,"select * from cptv_task where status is null and projeto like 'devblog' order by prioridade desc");
if (isset($_POST['task_devblog'])) {
	$titulo = $_POST['titulo'];
	$lvl = $_POST['prioridade'];
	$sql = "insert into cptv_task(titulo,prioridade,projeto) values ('$titulo','$lvl','devblog');";
	if(mysqli_query($db,$sql)){
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
	}
	header("location: index.php");
}

$tasks_fanatic = mysqli_query($db,"select * from cptv_task where status is null and projeto like 'fanaticsports' order by prioridade desc");
if (isset($_POST['task_devblog'])) {
	$titulo = $_POST['titulo'];
	$lvl = $_POST['prioridade'];
	$sql = "insert into cptv_task(titulo,prioridade,projeto) values ('$titulo','$lvl','fanaticsports');";
	if(mysqli_query($db,$sql)){
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
}
if (isset($_GET['task'])) {
	$task= $_GET['task'];
	$sql = "update cptv_task set status = 'done' where cod like $task";
	mysqli_query($db, $sql);
	header("location: index.php");
}

// OUTRAS INFORMAÇÕES
$membros = array(
	"Alex Yio Long Lin" => "419106053",
	"Ednaldo Junior" => "419103769",
	"Fábio Damião Araújo" => "419119927",
	"Guilherme Nunes Pedroso" => "419118123",
	"Guilherme William de Godoy" => "419119150",
	"João Moreira" => "419106506",
	"Rodrigo de Mendonça Cordeiro" => "419108124",
	"Marcos Gabriel Ribeiro Silva" => "419112367");
ksort($membros);

?>