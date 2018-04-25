<?php require_once("header.php");
require_once("conexao.php");

$id = $_POST['id'];
$nome_curso = strtoupper($_POST['nome_curso']);

if($id>0){	
	$query = "UPDATE curso SET nome_curso = '$nome_curso' WHERE idCurso = $id";
} else {
	$query = "INSERT INTO curso (nome_curso) VALUES ('{$nome_curso}')";	
}

mysqli_query($conexao, $query); 
header("Location: curso_form.php"); ?>