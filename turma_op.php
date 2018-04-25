<?php require_once("header.php");
require_once("conexao.php"); 

$id = $_POST['id'];
$id_curso = $_POST['id_curso'];
$periodo_turma = $_POST['periodo_turma'];
$semestre = $_POST['semestre'];

if ($id>0) {
	$query = "UPDATE turma SET id_curso = $id_curso, periodo_turma = $periodo_turma, semestre = $semestre WHERE id_turma = $id";
} else {
	$query = "INSERT INTO turma (id_curso, periodo_turma, semestre) VALUES ({$id_curso}, {$periodo_turma}, {$semestre})";
}

mysqli_query($conexao, $query);
header("Location: turma_form.php"); ?>