<?php require_once("header.php");
require_once("conexao.php"); 

$id = $_POST['id'];
$bloco = strtoupper($_POST['bloco']);
$nome_sala = $_POST['nome_sala'];
$andar = strtoupper($_POST['andar']);
$id_tipo_sala = $_POST['id_tipo_sala'];

if ($id>0) {
	$query = "UPDATE sala_info SET id_tipo_sala = $id_tipo_sala, bloco = '$bloco', nome_sala = '$nome_sala' WHERE id_sala = $id";
} else {
	$query = "INSERT INTO sala_info (id_tipo_sala, nome_sala, bloco, andar) VALUES ({$id_tipo_sala}, {$nome_sala}, '{$bloco}', '{$andar}')";
}

mysqli_query($conexao, $query);
header("Location: sala_form.php"); ?>