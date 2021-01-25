<?php
// Pasta onde o arquivo vai ser salvo
$_UP['pasta'] = 'uploads/';
 
// Tamanho máximo do arquivo (em Bytes)
$_UP['tamanho'] = 1024 * 1024 * 2; 
 
// Array com as extensões permitidas
$_UP['extensoes'] = array('txt', 'pdf', 'docx', 'jpg', 'png', 'bmp');
 
// Renomeia o arquivo?
$_UP['renomeia'] = false;
 
// Array com os tipos de erros de upload do PHP
$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
 
// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
if ($_FILES['arquivo']['error'] != 0) {
	die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivo']['error']]);
	exit; 
}
 
// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
// Faz a verificação da extensão do arquivo
//$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
//if (array_search($extensao, $_UP['extensoes']) === false) {
//	echo "Por favor, envie arquivos com as seguintes extensões: pdf, txt ou docx";
//}
 
// Faz a verificação do tamanho do arquivo
else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
	echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
}
 
// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
else {
	// Primeiro verifica se deve trocar o nome do arquivo
	$nome_final = $_FILES['arquivo']['name'];
 
// Depois verifica se é possível mover o arquivo para a pasta escolhida
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
	// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
	
	//SALVA AS INFORMAÇÕES DO UPLOAD NO BANCO
	require_once('conexao.php');
	if (session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
	
	$sql = "INSERT INTO arquivos (
						id_usuario,
						id_grupo,
						nome
								 ) values (
						".$_SESSION['userId'].",
						".$_SESSION['userGrupo'].",
						'".$nome_final."'
						)";
	mysqli_query($link, $sql);
	echo "<script>self.location = 'upload.php'</script>";
} else {
	// Não foi possível fazer o upload, provavelmente a pasta está incorreta
	echo "Não foi possível enviar o arquivo, tente novamente";
}
 
}


?>
