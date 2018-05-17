<?php require_once("header.php");
require_once("conexao.php"); 

// var_dump($_POST);
// die();

$id = $_POST['id'];
$id_turma = $_POST['id_turma'];
$id_sala = $_POST['idSala'];
$id_grade = $_POST['id_grade'];
$periodo_local = $_POST['periodo_local'];
$dia_semana = $_POST['dia_semana'];

if ($id>0) {
	$query = "UPDATE sala_local SET id_turma = $id_turma, id_sala = $id_sala, id_grade = $id_grade, periodoLocal = $periodo_local, dia_semana = $dia_semana WHERE id_sala_local = $id";
} else {
	$query = "INSERT INTO sala_local (id_turma, id_sala, id_grade, periodoLocal, dia_semana) VALUES ({$id_turma}, {$id_sala}, {$id_grade}, {$periodo_local}, {$dia_semana})";
}

mysqli_query($conexao, $query);
header("Location: turmaSala_form.php"); ?>