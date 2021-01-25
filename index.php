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
	if (session_status() !== PHP_SESSION_ACTIVE) {//Verificar se a sessão não já está aberta.
		session_start();
		$_SESSION['userLogin'] = '';
		$_SESSION['userId'] = '';
		$_SESSION['userGrupo'] = '';
	}
?>


<!-- FUNCOES -->
<script>
function wLogin() {
	document.getElementById("conteudo").src = 'login.php';
}
function wDashboard() {
	document.getElementById("conteudo").src = 'dashboard.php';
}
function wCadUsuarios() {
	document.getElementById("conteudo").src = 'cadUsuarios.php';
}
function wCadGrupos() {
	document.getElementById("conteudo").src = 'cadGrupos.php';
}
function wUpload() {
	document.getElementById("conteudo").src = 'upload.php';
}

</script>

<body class="index" cellpadding='0' cellspacing='0'>
	<div class="dash_main">
		<table style='width:100%;height:600px' cellspacing='2px' cellpadding='2px'>
			<td style='width:200px;height:100%' class='mainmenu' align='center' valign='top'>

				<table style='width:100%;height:30' >
					<td style='width:100%;height:100%' align='center' valign='top'>
					  MENU
					</td>
				</table>
				<table style='width:100%;height:30' >
					<td style='width:100%;height:100%' align='center' valign='top'>
						<button class='btnMenu' onClick='wLogin()'>Login</button><br>
						<button class='btnMenu' onClick='wDashboard()'>Dashboard</button><br>
						<button class='btnMenu' onClick='wCadUsuarios()'>Cadastro de Usuários</button><br>
						<button class='btnMenu' onClick='wCadGrupos()'>Cadastro de Grupos</button>
						<button class='btnMenu' onClick='wUpload()'>Upload de arquivos</button>
					</td>
				</table>
			</td>

			<td style='height:100%' class='mainmenu' align='center' valign='top'>
				<iframe name="conteudo" id="conteudo" src='dashboard.php' height="100%" width="100%" border='0' cellpadding='0' ></iframe>	
			</td>
		</table>
	</div>
</html>