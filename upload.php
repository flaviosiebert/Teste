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
	
	if (isset($_GET['arq'])) {
		echo $_GET['arq'];
	}

?>

<!-- FUNCOES -->
<script>
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
					  <b>UPLOAD DE ARQUIVOS</b>
					  <hr>
					</td>
				</table>

				<?php
					if (!isset($_SESSION['userLogin'])) {
						echo "<table style='width:100%;height:550' >
							<td style='width:100%;height:100%' align='center' valign='top' >
								<p>
								<img src='imagens/aviso.png' width='46px' height='46px' >
								<br>Faça o login para continuar.
							</td>
						</table>";
						exit;
					} else {
						echo "<table style='width:100%;height:250' cellpadding='5' cellspacing='5' >
							<td style='width:100%;height:100%' align='left' valign='top'>
								<table style='width:100%;height:100%' >";
								echo "<form method=post action=recebe_upload.php enctype=multipart/form-data>";
								echo "<label>Arquivo:</label>";
								echo "<p>";
								echo "<input type='file' name='arquivo' />";
								echo "<p>";
								echo "<input type='submit' value='Enviar' />";
								echo "</form>";
								echo "</table>
							</td>
						</table>";
					}
					echo "<hr>";
						echo "<table style='width:100%;height:250' cellpadding='5' cellspacing='5' >
							<td style='width:100%;height:100%' align='left' valign='top'>
								Último arquivo enviado:&nbsp;<b>";
								$query = "SELECT * FROM arquivos where id_usuario=".$_SESSION['userId']." ORDER BY id_arquivo DESC LIMIT 1";
								
								$res = mysqli_query($link, $query) or die(mysqli_error($link));
								$row = mysqli_fetch_assoc($res);
								echo $row['nome'];
								
							echo "</b></td>
						</table>";

				?>
			</td>
		</table>

	</div>

</html>