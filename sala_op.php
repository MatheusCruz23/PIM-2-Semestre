<?php require_once("header.php");
require_once("conexao.php"); 

$id = $_POST['id'];
$bloco = strtoupper($_POST['bloco']);
$nome_sala = $_POST['nome_sala'];
$andar = strtoupper($_POST['andar']);
$idTipoSala = $_POST['idTipoSala'];
$capacidadeAluno = $_POST['capacidadeAluno'];


if ($id>0) {
	$query = "UPDATE sala_info SET id_tipo_sala = $idTipoSala, bloco = '$bloco', nome_sala = '$nome_sala', qnto_lugar = $capacidadeAluno WHERE idSala = $id";
} else {
	$query = "INSERT INTO sala_info (id_tipo_sala, nome_sala, bloco, andar, qnto_lugar) VALUES ({$idTipoSala}, {$nome_sala}, '{$bloco}', {$andar}, {$capacidadeAluno})";	
}

mysqli_query($conexao, $query);
header("Location: sala_form.php"); ?>