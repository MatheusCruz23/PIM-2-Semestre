<?php require_once("header.php");
require_once("conexao.php"); 

$id = $_POST['id'];
$id_curso = $_POST['id_curso'];
$id_disciplina = $_POST['id_disciplina'];
$id_professor = $_POST['id_professor'];

if ($id>0) {
	$query = "UPDATE grade SET id_curso = $id_curso, id_disciplina = $id_disciplina, id_professor = $id_professor WHERE id_grade = $id";
} else {
	$query = "INSERT INTO grade (id_disciplina, id_curso, id_professor) VALUES ({$id_disciplina}, {$id_curso}, {$id_professor})";	
}

mysqli_query($conexao, $query);
header("Location: grade_form.php"); ?>