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
	if (session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
	if (isset($_GET['logout'])) {
		unset($_SESSION['userLogin']);
		unset($_SESSION['userId']);
	}
	require_once('conexao.php');
	$msgErro = '';
	if ((isset($_POST['logEmail'])) and (isset($_POST['logSenha']))) {
		//PROCURA O LOGIN NA BASE DE DADOS
		$query = "select * from USUARIOS
		                  where email='".$_POST['logEmail']."'
		                    and senha='".$_POST['logSenha']."'";
		
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$total = mysqli_fetch_assoc($result);
		if ($total > 0) {
			$result = mysqli_query($link, $query) or die(mysqli_error($link));
			$row = mysqli_fetch_assoc($result);
			$_SESSION['userLogin'] = $row['nome'];
			$_SESSION['userId']    = $row['id_usuario'];
			$_SESSION['userGrupo'] = $row['id_grupo'];
			echo "<script>alert('Usuário logado com sucesso.');</script>"; 
			echo "<script>self.location = 'dashboard.php';</script>"; 
			exit;
		} else {
			unset($_SESSION['userLogin']);
			unset($_SESSION['userId']);
			unset($_SESSION['userGrupo']);
			$msgErro = 'Email ou senha incorretos!';
		}
	}
?>


<!-- FUNCOES -->
<script>

function setFocus() {
	document.getElementById('logEmail').focus();
}

function fncLogout() {
	self.location = 'login.php?logout=S';
}


function validaDados() {
	var sEmail = document.getElementById('logEmail');
	if (sEmail.value == '') {
		alert('Informe seu e-mail de login!');
		setFocus();
		return false;
	}
	var sSenha = document.getElementById('logSenha');
	if (sSenha.value == '') {
		alert('Informe a sua senha de acesso!');
		sSenha.Focus();
		return false;
	}
}


function fncCancelar() {
	var r = confirm("Deseja sair da tela de login ?");
	if (r == true) {
		self.location = 'dashboard.php';
	}	
}

function fncCadastro() {
	self.location = 'novoUsuario.php';
}

</script>

<body class="index" cellpadding='0' cellspacing='0'>
	<div class="dash_main">
		<table style='width:100%;height:600px' cellspacing='2px' cellpadding='2px'>
			<td style='height:100%' class='mainmenu' align='center' valign='top'>
				<table style='width:100%;height:30' >
					<td style='width:100%;height:100%' align='right' valign='top'>
						Usuário: &nbsp;
						<?php
							if ((isset($_SESSION['userLogin'])) and ($_SESSION['userLogin'] <> '')) {
								echo $_SESSION['userLogin'];
							} else {
								echo "Não logado";
							}
						?>
					</td>
				</table>
				<table style='width:100%;height:30' >
					<td style='width:100%;height:100%' align='center' valign='top'>
					  <b>LOGIN</b>
					  <hr>
					</td>
				</table>
				<?php
					if ((isset($_SESSION['userLogin'])) and ($_SESSION['userLogin'] <> '')) {
						echo "
							<table style='width:100%;height:550' >
								<td style='width:100%;height:100%' align='center' valign='top'>
									Usuário logado como ".$_SESSION['userLogin']."
									<br><br>
									<button class='btnDefault' name='btnOk' id='btnOk' onClick='fncLogout()' >Logout</button>
								</td>
							</table>";
					} else {
						echo "
						<form name='formLogin' id='formLogin' method='post' onsubmit='return validaDados()'>
							<table style='width:100%;height:550' >
								<td style='width:100%;height:100%' align='center' valign='top'>
									E-mail:<br>
									<input type='text' name='logEmail' id='logEmail' style='width:200px'><br>
									Senha:<br>
									<input type='password' name='logSenha' id='logSenha' style='width:200px'>
									<br><br>
									<button class='btnDefault' name='btnOk' id='btnOk' type='submit' >Entrar</button>
									<button class='btnDefault' name='btnCancel' id='btnCancel' type='reset' onClick='fncCancelar()'>Cancelar</button>";
									if ($msgErro <> '') {
										echo "<hr><font color='red'>".$msgErro."</font>";
									}
								echo "</td>
							</table>
						</form>
						<hr>
						<table style='width:100%;height:550' >
							<td style='width:100%;height:100%' align='center' valign='top'>
								Caso não tenha cadastro, clique aqui:<p>
								<button class='btnDefault' name='btnNovo' id='btnNovo' onClick='fncCadastro()'>Cadastre-se</button>
							</td>
						</table>";
					}
				?>
				
			</td>
		</table>
	</div>

</html>