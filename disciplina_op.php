<?php require_once("header.php");
require_once("conexao.php");
$id = $_POST['id'];
$nome_disciplina = strtoupper($_POST['nome_disciplina']);

if ($id>0) {
	$query = "UPDATE disciplina SET nome_disciplina = '$nome_disciplina' WHERE id_disciplina = $id";
} else {
	$query = "INSERT INTO disciplina (nome_disciplina) VALUES ('{$nome_disciplina}')";
}

mysqli_query($conexao, $query);
header("Location: disciplina_form.php"); ?>