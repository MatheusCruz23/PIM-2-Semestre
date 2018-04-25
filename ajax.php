<?php 
require_once("conexao.php");

$query = "SELECT grade.*, disciplina.*, curso.*, turma.*, professor.* FROM grade 
      INNER JOIN disciplina ON grade.id_disciplina = disciplina.id_disciplina 
      INNER JOIN curso ON grade.id_curso = curso.id_curso 
      INNER JOIN turma ON turma.id_curso = curso.id_curso
      INNER JOIN professor ON grade.id_professor = professor.id_professor
      WHERE turma.id_turma = {$_GET['id']}
      ORDER BY nome_disciplina ASC";
      $disciplina = mysqli_query($conexao, $query);
      echo '<option value="">Selecione a Disciplina</option>';
      while ($listaDisciplina = mysqli_fetch_assoc($disciplina)) { 
       echo '<option value="'.$listaDisciplina['id_grade'].'" >'.$listaDisciplina['nome_disciplina'].' - '. $listaDisciplina['nome_professor'].'</option>';
   	} ?>