<!doctype html>


<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="estilo.css">
		<meta charset="utf-8">
		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>.: Dashboard :.</title>
		<meta name="description" content="Dashboard - teste Flávio B. Siebert" />
		<meta name="keywords" content="teste, usuário, grupo, dashboard, arquivos, upload" />
	</head>


<?php
	require_once('conexao.php');
	if (session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
	$usuarioCriado = '';
	if (isset($_POST['cadEmail'])) {
		$sql = "INSERT INTO usuarios (
							email,
							nome,
							senha,
							id_grupo
   							         ) values (
						    '".$_POST['cadEmail']."',
						    '".$_POST['cadNome']."',
						    '".$_POST['cadSenha1']."',
						    ".$_POST['cadGrupos']."
							)";
		if(mysqli_query($link, $sql)) {
			$usuarioCriado = $_POST['cadNome'];
		}			
	}
?>



<!-- FUNCOES -->
<script>

function setFocus() {
	document.getElementById('cadEmail').focus();
}

function fncNovoGrupo() {
	self.location = 'novoGrupo.php?voltar=S';
}

function fncCancelar() {
	var r = confirm("Deseja sair da tela de cadastro ?");
	if (r == true) {
		self.location = 'dashboard.php';
	}	
}

function fncSair() {
	self.location = 'cadUsuarios.php';
}

function fncLogin() {
	self.location = 'login.php';
}

function validaDados() {
	var sEmail = document.getElementById('cadEmail');
	if (sEmail.value == '') {
		alert('Informe seu e-mail!');
		setFocus();
		return false;
	}

	var sNome = document.getElementById('cadNome');
	if (sNome.value == '') {
		alert('Informe o seu nome!');
		sNome.focus();
		return false;
	}

	var sSenha1 = document.getElementById('cadSenha1');
	if (sSenha1.value == '') {
		alert('Informe uma senha!');
		sSenha1.focus();
		return false;
	}

	if (sSenha1.value.length < 6) {
		alert('A senha deve ter entre 6 e 8 caracteres!');
		sSenha1.focus();
		return false;
	}

	var sSenha2 = document.getElementById('cadSenha2');
	if (sSenha2.value == '') {
		alert('Repita a senha para validação!');
		sSenha2.focus();
		return false;
	}
	
	if (sSenha1.value != sSenha2.value) {
		alert('As senhas informadas não são iguais, tente novamente.');
		sSenha2.focus();
		return false;
	}
}

function fncVoltar() {
	history.back();
}

</script>

<body class="index" cellpadding='0' cellspacing='0' onLoad='setFocus()'>
	<div class="dash_main">
		<table style='width:100%;height:600px' cellspacing='2px' cellpadding='2px'>
			<td style='height:100%' class='mainmenu' align='center' valign='top'>
				<table style='width:100%;height:30' >
					<td style='width:100%;height:100%' align='center' valign='top'>
					  <b>NOVO USUÁRIO</b>
					  <hr>
					</td>
				</table>

				<table style='width:100%;height:350' >
					<td style='width:100%;height:100%' align='Left' valign='top'>
						<form name='formUsuario' id='formUsuario' method="post" onSubmit='return validaDados()'>

						E-mail:<br>
						<input type='text' name='cadEmail' id='cadEmail' style='width:300px' max='100'><br>
						Nome:<br>
						<input type='text' name='cadNome' id='cadNome' style='width:300px' max='100'><br>
						Senha:<br>
						<input type='password' name='cadSenha1' id='cadSenha1' style='width:100px' max='8'><br>
						Senha (repita a mesma):<br>
						<input type='password' name='cadSenha2' id='cadSenha2' style='width:100px' max='8'><br>
						<hr>
						Grupo:<br>
							<?php
								echo "<select name='cadGrupos' id='cadGrupos' style='width:300px'>";
								mysqli_connect($link);
								$query = "select * from grupos order by nome";
								$result = mysqli_query($link, $query) or die(mysqli_error($link));
								while ($row = mysqli_fetch_assoc($result)) {
										echo "<option value='".$row['id_grupo']."'>".$row['nome']."</option>";
								}
								echo "</select>";
							?>
						<button class='btnDefault' name='btnNovoGrupo' id='btnNovoGrupo' type='reset' onClick='fncNovoGrupo()'>Novo Grupo</button>
						<hr>
						<br><br>
						<button class='btnDefault' name='btnOk' id='btnOk' type='submit'>OK</button>
						<button class='btnDefault' name='btnCancel' id='btnCancel' type='reset' onClick='fncCancelar()'>Cancelar</button>
						</form>
						
					</td>
				</table>
				
			
				<?php
					if ($usuarioCriado <> '') {
						echo "<hr>";
						echo "Usuário (".$usuarioCriado.") criado com sucesso.";
						echo "<br><br>";
						echo "<button class='btnDefault' name='btnSair' id='btnSair' onClick='fncSair()'>Ver usuários</button>";
						echo "<button class='btnDefault' name='btnLogin' id='btnLogin' onClick='fncLogin()'>Login</button>";
					}
				?>

			</td>
		</table>
	</div>
</html>