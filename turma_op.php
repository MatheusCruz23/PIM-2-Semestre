<?php require_once("header.php");
require_once("conexao.php"); 

$id = $_POST['id'];
$id_curso = $_POST['id_curso'];
$periodo_turma = $_POST['periodo_turma'];
$semestre = $_POST['semestre'];
$turma_nome =  strtoupper($_POST['turma_nome']);
$qnto_aluno = $_POST['qnto_aluno'];

if ($id>0) {
	$query = "UPDATE turma SET id_curso = $id_curso, periodo_turma = $periodo_turma, semestre = $semestre, turma_nome = '$turma_nome', qnto_aluno = $qnto_aluno WHERE id_turma = $id";
} else {
	$query = "INSERT INTO turma (id_curso, periodo_turma, semestre, turma_nome, qnto_aluno) VALUES ({$id_curso}, {$periodo_turma}, {$semestre}, '{$turma_nome}', {$qnto_aluno})";
}

mysqli_query($conexao, $query);
header("Location: turma_form.php"); ?>