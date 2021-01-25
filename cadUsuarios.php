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
	if (isset($_GET['delIdUsuario'])) {
		$query = "delete from usuarios where id_usuario = ".$_GET['delIdUsuario'];
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
	}
?>

<!-- FUNCOES -->
<script>
function abreUsuario(nId) {
	self.location = 'editUsuario.php?idUsuario='+nId;
}

function apagaUsuario(nId) {
	var r = confirm("Confirma exclusão deste usuário ?");
	if (r == true) {
		self.location = 'cadUsuarios.php?delIdUsuario='+nId;
	}	
}

function fncNovoUsuario() {
	self.location = 'novoUsuario.php';
}

function atualizar() {
	self.location = 'cadUsuarios.php';
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
					  <b>CADASTRO DE USUÁRIOS</b>
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
						echo "<table style='width:100%;height:30' >
							<td style='width:100%;height:100%' align='left' valign='top'>
							  <button class='btnDefault' name='btnOk' id='btnOk' onClick='fncNovoUsuario()' >Novo usuário</button>
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
										Nome:
									</td>
									<td style='width:300px;height:100%' class='titGrid' align='center' valign='middle'>
										E-mail:
									</td>
									<td style='height:100%' class='titGrid' align='center' valign='middle'>
										Grupo:
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
						$query = "select u.*, g.nome as nomegrupo from usuarios u 
						                        left join grupos g
									                   on g.id_grupo = u.id_grupo
 						                         order by u.nome";
						$result = mysqli_query($link, $query) or die(mysqli_error($link));
						echo "<table style='width:100%;height:550' >
							<td style='width:100%;height:100%' align='left' valign='top'>";
								while ($row = mysqli_fetch_assoc($result)) {
									echo "<table style='width:100%;height:100%' >";
									echo "<td style='width:40px;height:100%' class='gridList' align='center' valign='middle'>";
										echo $row['id_usuario'];
									echo "</td>";
									echo "<td style='width:300px;height:100%' class='gridList' align='left' valign='middle'>";
										echo $row['nome'];
									echo "</td>";
									echo "<td style='width:300px;height:100%' class='gridList' align='left' valign='middle'>";
										echo $row['email'];
									echo "</td>";
									echo "<td style='height:100%' class='gridList' align='left' valign='middle'>";
										echo $row['nomegrupo'];
									echo "</td>";
									echo "<td style='width:36px;height:100%' class='gridList' align='center' valign='middle'>";
										echo "<img src='imagens/edit.jpg' style='width:16px;height:16px' onClick='abreUsuario(".$row['id_usuario'].")'>";
									echo "</td>";
									echo "<td style='width:36px;height:100%' class='gridList' align='center' valign='middle'>";
										echo "<img src='imagens/lixo.png' style='width:16px;height:16px' onClick='apagaUsuario(".$row['id_usuario'].")'>";
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