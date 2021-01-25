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
			$sql = "INSERT INTO grupos (nome) values ('".$_POST['cadGrupo']."')";
			if(mysqli_query($link, $sql)) {
				$grupoCriado = $_POST['cadGrupo'];
			}			
		}
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
	var r = confirm("Deseja sair da tela de cadastro ?");
	if (r == true) {
		self.location = 'dashboard.php';
	}	
}

function fncSair() {
	self.location = 'cadGrupos.php';
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
					  <b>NOVO GRUPO</b>
					  <hr>
					</td>
				</table>

				<table style='width:100%;height:250' >
					<td style='width:100%;height:100%' align='Left' valign='top'>
						Descrição do grupo:<br>
						<form name='formGrupo' id='formGrupo' method="post" onSubmit='return validaDados()'>
						<input type='text' name='cadGrupo' id='cadGrupo' style='width:300px' max='100'>
						<br><br>
						<button class='btnDefault' name='btnOk' id='btnOk' type='submit' >Salvar</button>
						<?php
							if ($_GET['voltar'] == 'S') {
								echo "<button class='btnDefault' name='btnVoltar' id='btnVoltar' type='reset' onClick='fncVoltar()'>Voltar</button>";
							} else {
								echo "<button class='btnDefault' name='btnCancel' id='btnCancel' type='reset' onClick='fncCancelar()'>Cancelar</button>";
							}
						?>
						</form>
					</td>
				</table>
				
				<?php
					if ($grupoCriado <> '') {
						echo "<hr>";
						echo "Grupo (".$grupoCriado.") criado com sucesso.";
						echo "<br><br>";
						echo "<button class='btnDefault' name='btnSair' id='btnSair' onClick='fncSair()'>Ver grupos</button>";
						if ($_GET['voltar'] == 'S') {
							echo "<button class='btnDefault' name='btnVoltar' id='btnVoltar' onClick='fncVoltar()'>Voltar</button>";
						}
					}
				?>
				
			</td>
		</table>
	</div>

</html>