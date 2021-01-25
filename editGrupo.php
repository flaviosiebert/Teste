<!doctype html>
<?php require_once('conexao.php'); ?>

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
	$grupoCriado = '';
	if (isset($_POST['cadGrupo'])) {
		if ($_POST['cadGrupo'] <> '') {
			$sql = "UPDATE grupos set nome = '".$_POST['cadGrupo']."'
			         where id_grupo = ".$_GET['idGrupo'];
			
			if(mysqli_query($link, $sql)) {
				echo "<script>Alert('Grupo editado com sucesso');</script>";
				echo "<script>self.location = 'cadGrupos.php';</script>";
			}			
		}
	}
	
	
	if (isset($_GET['idGrupo'])) {
		$query = "select * from grupos where id_grupo = ".$_GET['idGrupo'];
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$row = mysqli_fetch_assoc($result);
	}

?>

<!-- FUNCOES -->
<script>

function setFocus() {
	document.getElementById('cadGrupo').focus();
}

function validaDados() {
	var sGrupo = document.getElementById('cadGrupo');
	if (sGrupo.value == '') {
		alert('Informe uma descrição válida!');
		setFocus();
		return false;
	}
}

function fncCancelar() {
	var r = confirm("cancelar edição ?");
	if (r == true) {
		self.location = 'cadGrupos.php';
	}	
}

</script>

<body class="index" cellpadding='0' cellspacing='0' onLoad='setFocus()'>
	<div class="dash_main">
		<table style='width:100%;height:600px' cellspacing='2px' cellpadding='2px'>
			<td style='height:100%' class='mainmenu' align='center' valign='top'>
				<table style='width:100%;height:30' >
					<td style='width:100%;height:100%' align='center' valign='top'>
					  <b>EDITAR DADOS DO GRUPO</b>
					  <hr>
					</td>
				</table>

				<table style='width:100%;height:250' >
					<td style='width:100%;height:100%' align='Left' valign='top'>
						Descrição do grupo:<br>
						<form name='formGrupo' id='formGrupo' method="post" onSubmit='return validaDados()'>
						<?php
							echo "<input type='text' name='cadGrupo' id='cadGrupo' style='width:300px' max='100' value='".$row['nome']."'>";
						?>
						<br><br>
						<button class='btnDefault' name='btnOk' id='btnOk' type='submit' >Salvar</button>
						<button class='btnDefault' name='btnCancel' id='btnCancel' type='reset' onClick='fncCancelar()'>Cancelar</button>
						</form>
					</td>
				</table>
				
			</td>
		</table>
	</div>

</html>