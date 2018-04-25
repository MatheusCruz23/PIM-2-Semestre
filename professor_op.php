<?php require_once("header.php");
require_once("conexao.php"); 

$id = $_POST['id'];
$nome_professor = strtoupper($_POST['nome_professor']);

if ($id>0) {
	$query = "UPDATE professor SET nome_professor = '$nome_professor' WHERE idProfessor = $id";
} else {
	$query = "INSERT INTO professor (nome_professor) VALUES ('{$nome_professor}')";
}

mysqli_query($conexao, $query);
header("Location: professor_form.php"); ?>