<?php
	$idArquivo = $_GET["idArquivo"];
	
	require_once('conexao.php');
	if (session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}

	$query = "select * from arquivos where id_arquivo = ".$idArquivo;
	$res = mysqli_query($link, $query) or die(mysqli_error($link));
	$row = mysqli_fetch_assoc($res);

   $Arquivo = "uploads/".$row['nome'];
   
	$file_url = $Arquivo;
	header('Content-Type: application/octet-stream');
	header("Content-Transfer-Encoding: Binary"); 
	header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
	readfile($file_url);    
?>
