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
		$sql = "update usuarios set
							email    = '".$_POST['cadEmail']."',
							nome     = '".$_POST['cadNome']."',
							id_grupo = ".$_POST['cadGrupos']."
						where id_usuario = ".$_GET['idUsuario']."";
		if(mysqli_query($link, $sql)) {
			echo "<script>Alert('Usuário editado com sucesso');</script>";
			echo "<script>self.location = 'cadUsuarios.php';</script>";
		}			
	}
	
	if (isset($_GET['idUsuario'])) {
		$query = "select * from usuarios where id_usuario = ".$_GET['idUsuario'];
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$row = mysqli_fetch_assoc($result);
	}

?>


<!-- FUNCOES -->
<script>

function setFocus() {
	document.getElementById('cadEmail').focus();
}

function fncCancelar() {
	var r = confirm("Deseja sair da tela de cadastro ?");
	if (r == true) {
		self.location = 'cadUsuarios.php';
	}	
}

function fncSair() {
	self.location = 'cadUsuarios.php';
}

function validaDados() {
	var sEmail = document.getElementById('cadEmail');
	if (sEmail.value == '') {
		alert('Informe u e-mail válido!');
		setFocus();
		return false;
	}

	var sNome = document.getElementById('cadNome');
	if (sNome.value == '') {
		alert('Informe o seu nome!');
		sNome.focus();
		return false;
	}
}

</script>

<body class="index" cellpadding='0' cellspacing='0' onLoad='setFocus()'>
	<div class="dash_main">
		<table style='width:100%;height:600px' cellspacing='2px' cellpadding='2px'>
			<td style='height:100%' class='mainmenu' align='center' valign='top'>
				<table style='width:100%;height:30' >
					<td style='width:100%;height:100%' align='center' valign='top'>
					  <b>EDITAR DADOS DO USUÁRIO</b>
					  <hr>
					</td>
				</table>

				<table style='width:100%;height:350' >
					<td style='width:100%;height:100%' align='Left' valign='top'>
						<form name='formUsuario' id='formUsuario' method="post" onSubmit='return validaDados()'>
						<?php
						echo "E-mail:<br>";
						echo "<input type='text' name='cadEmail' id='cadEmail' style='width:300px' max='100' value='".$row['email']."'><br>";
						echo "Nome:<br>";
						echo "<input type='text' name='cadNome' id='cadNome' style='width:300px' max='100' value='".$row['nome']."'><br>";
						echo "Grupo:<br>";
							echo "<select name='cadGrupos' id='cadGrupos' style='width:300px'>";
							mysqli_connect($link);
							$queryLista = "select * from grupos order by nome";
							$resLista = mysqli_query($link, $queryLista) or die(mysqli_error($link));
							while ($rowLista = mysqli_fetch_assoc($resLista)) {
								if ($rowLista['id_grupo'] == $row['id_grupo']) {
									echo "<option  selected value='".$rowLista['id_grupo']."'>**".$rowLista['nome']."</option>";
								} else {
									echo "<option value='".$rowLista['id_grupo']."'>".$rowLista['nome']."</option>";
								}
							}
							echo "</select>";
						?>
						<hr>
						<br><br>
						<button class='btnDefault' name='btnOk' id='btnOk' type='submit'>OK</button>
						<button class='btnDefault' name='btnCancel' id='btnCancel' type='reset' onClick='fncCancelar()'>Cancelar</button>
						</form>
						
					</td>
				</table>
			</td>
		</table>
	</div>
</html>