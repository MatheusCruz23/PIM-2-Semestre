<?php 
require_once("conexao.php");

// Recebe o id da turma para fazer a query trazendo a disciplina com o professor
$query = "SELECT * FROM grade
      JOIN disciplina ON grade.id_disciplina = disciplina.idDisciplina
      JOIN curso ON grade.id_curso = curso.idCurso
      JOIN turma ON curso.idCurso = turma.id_curso
      JOIN professor ON grade.id_professor = professor.idProfessor
      WHERE turma.idTurma = {$_GET['id']}
      ORDER BY nome_disciplina";

      $disciplina = mysqli_query($conexao, $query);
      echo '<option value="">Selecione a Disciplina</option>';
      while ($listaDisciplina = mysqli_fetch_assoc($disciplina)) { 
       echo '<option value="'.$listaDisciplina['idGrade'].'" >'.$listaDisciplina['nome_disciplina'].' - '. $listaDisciplina['nome_professor'].'</option>';
   	} ?>