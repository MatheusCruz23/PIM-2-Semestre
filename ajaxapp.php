<?php 
include("conexao.php");

if ($_GET['acao'] == 1) {
	$query = " SELECT * FROM cursos"
} else if($_GET['acao'] == 2) {
	$query = "SELECT * FROM "
}

/*
QUERY PARA BUSCAR COM A TURMA
SELECT disciplina.nome_disciplina, professor.nome_professor, sala_info.bloco, sala_info.nome_sala, sala_info.andar FROM sala_local
JOIN turma ON sala_local.id_turma = turma.idTurma
JOIN grade ON sala_local.id_grade = grade.idGrade
JOIN professor ON grade.id_professor = professor.idProfessor
JOIN sala_info ON sala_local.id_sala = sala_info.idSala
JOIN disciplina ON grade.id_disciplina = disciplina.idDisciplina
WHERE turma.turma_nome = 'DS2P17'




QUERY PARA BUSCCAR A TURMA PELO SELECT
SELECT disciplina.nome_disciplina, professor.nome_professor, sala_info.bloco, sala_info.nome_sala, sala_info.andar FROM sala_local
JOIN turma ON sala_local.id_turma = turma.idTurma
JOIN grade ON sala_local.id_grade = grade.idGrade
JOIN professor ON grade.id_professor = professor.idProfessor
JOIN sala_info ON sala_local.id_sala = sala_info.idSala
JOIN disciplina ON grade.id_disciplina = disciplina.idDisciplina
WHERE sala_local.dia_semana = 1
AND turma.semestre = 2
AND turma.periodo_turma = 3
AND grade.id_curso = 3


JUNTANDO AS DUAS QUERY
SELECT disciplina.nome_disciplina, professor.nome_professor, sala_info.bloco, sala_info.nome_sala, sala_info.andar FROM sala_local
JOIN turma ON sala_local.id_turma = turma.idTurma
JOIN grade ON sala_local.id_grade = grade.idGrade
JOIN professor ON grade.id_professor = professor.idProfessor
JOIN sala_info ON sala_local.id_sala = sala_info.idSala
JOIN disciplina ON grade.id_disciplina = disciplina.idDisciplina
if(){
	WHERE turma.turma_nome = 'DS2P17'
} else {
	WHERE sala_local.dia_semana = 1
	AND turma.semestre = 2
	AND turma.periodo_turma = 3
	AND grade.id_curso = 3
}

*/
 ?>
