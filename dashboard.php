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
	if (isset($_GET['delIdArquivo'])) {
		$query = "delete from arquivos where id_arquivo = ".$_GET['delIdArquivo'];
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
	}
?>

<!-- FUNCOES -->
<script>
function abreArquivo(nId) {
	self.location = 'baixar.php?idArquivo='+nId;
}

function apagaArquivo(nId) {
	var r = confirm("Confirma exclusão deste arquivo ?");
	if (r == true) {
		self.location = 'dashboard.php?delIdArquivo='+nId;
	}	
}

function fncNovoUpload() {
	self.location = 'upload.php';
}

function atualizar() {
	self.location = 'dashboard.php';
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
					  <b>DASHBOARD</b>
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
								<hr>Clique no botão 'login' no menu à esquerda.
							</td>
						</table>";
						exit;
					} else {
						echo "<table style='width:100%;height:30' >
							<td style='width:100%;height:100%' align='left' valign='top'>
							  <button class='btnDefault' name='btnOk' id='btnOk' onClick='fncNovoUpload()' >Upload</button>
							  <button class='btnDefault' name='btnOk' id='btnOk' onClick='fncAtualizar()' >Atualizar</button>
							</td>
						</table>";
						echo "<table style='width:100%;height:550' >
							<td style='width:100%;height:100%' align='left' valign='top'>
								<table style='width:100%;height:100%' >
									<td style='width:40px;height:100%' class='titGrid' align='center' valign='middle'>
										ID
									</td>
									<td style='width:300px;height:100%' class='titGrid' align='center' valign='middle'>
										Arquivo:
									</td>
									<td style='width:300px;height:100%' class='titGrid' align='center' valign='middle'>
										Grupo:
									</td>
									<td style='height:100%' class='titGrid' align='center' valign='middle'>
										Usuário:
									</td>
									<td style='width:36px;height:100%' class='titGrid' align='center' valign='middle'>
										...
									</td>
									<td style='width:36px;height:100%' class='titGrid' align='center' valign='middle'>
										...
									</td>
								</table>
							</td>
						</table>";
						//loop de dados
						$query = "select a.*,
                                         u.nome as nomeUsuario,
                                         g.nome as nomeGrupo
                                    from arquivos a
                               left join usuarios u
                                      on u.id_usuario =  a.id_usuario
                               left join grupos g
                                      on g.id_grupo = a.id_grupo
							       where a.id_usuario = ".$_SESSION['userId']."
                                order by a.nome";
						
						$result = mysqli_query($link, $query) or die(mysqli_error($link));
						echo "<table style='width:100%;height:550' >
							<td style='width:100%;height:100%' align='left' valign='top'>";
								while ($row = mysqli_fetch_assoc($result)) {
									echo "<table style='width:100%;height:100%' >";
									echo "<td style='width:40px;height:100%' class='gridList' align='center' valign='middle'>";
										echo $row['id_arquivo'];
									echo "</td>";
									echo "<td style='width:300px;height:100%' class='gridList' align='left' valign='middle'>";
										echo $row['nome'];
									echo "</td>";
									echo "<td style='width:300px;height:100%' class='gridList' align='left' valign='middle'>";
										echo $row['nomeGrupo'];
									echo "</td>";
									echo "<td style='height:100%' class='gridList' align='left' valign='middle'>";
										echo $row['nomeUsuario'];
									echo "</td>";
									echo "<td style='width:36px;height:100%' class='gridList' align='center' valign='middle'>";
										echo "<img src='imagens/download.png' style='width:16px;height:16px' onClick='abreArquivo(".$row['id_arquivo'].")'>";
									echo "</td>";
									echo "<td style='width:36px;height:100%' class='gridList' align='center' valign='middle'>";
										echo "<img src='imagens/lixo.png' style='width:16px;height:16px' onClick='apagaArquivo(".$row['id_arquivo'].")'>";
									echo "</td>";
								echo "</table>";
								}

							echo "</td>
						</table>";
					}
				?>
			</td>
		</table>
	</div>

</html>