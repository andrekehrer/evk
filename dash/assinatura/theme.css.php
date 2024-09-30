<?php
header("Content-type: text/css");
require_once('../includes/conexao.php');
	$query = "SELECT css FROM temas WHERE tema='".$_GET['ln']."'";
	$result = $pdo->query($query);
	$linha = $result->fetch(PDO::FETCH_ASSOC);
	echo $linha['css'];
?>
	
