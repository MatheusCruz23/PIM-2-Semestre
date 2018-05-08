<?php require_once("header.php"); 
require_once("conexao.php");
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT grade.*, curso.*, disciplina.*, professor.* FROM grade 
  INNER JOIN curso ON grade.id_curso = curso.id_curso 
  INNER JOIN disciplina ON grade.id_disciplina = disciplina.id_disciplina 
  INNER JOIN professor ON grade.id_professor = professor.id_professor 
  WHERE id_grade = $id";
  $resulEditar = mysqli_query($conexao, $query);
  $resultadoEditar = mysqli_fetch_assoc($resulEditar);

  $idCurso = $resultadoEditar['id_curso'];
  $idDisciplina = $resultadoEditar['id_disciplina'];
  $idProfessor = $resultadoEditar['id_professor'];
  $nome_curso = $resultadoEditar['nome_curso'];
  $nome_disciplina = $resultadoEditar['nome_disciplina'];
  $nome_professor = $resultadoEditar['nome_professor'];
} else {
  $id = 0;
  $idCurso = '';
  $idDisciplina = '';
  $idProfessor = '';
  $nome_curso = '';
  $nome_disciplina = '';
  $nome_professor = '';
}

if (isset($_SESSION['id_usuario'])) { ?>

<div class="titulo">
	<h2>Montar a Grade</h2>
</div>

<form action="grade_op.php" method="post">
  <input type="hidden" value="<?=$id;?>" name="id">
  <div class="form-group">
    <label for="exampleInputEmail1">Curso</label>
    <select name="idCurso" id="" class="form-control" required>
      <option value="">Selecione um Curso</option>
      <?php 
      $query = "SELECT * FROM curso ORDER BY nome_curso ASC";
      $curso = mysqli_query($conexao, $query);
      while($listaCurso = mysqli_fetch_assoc($curso)){ ?>
        <option value="<?=$listaCurso['idCurso']?>" <?php if ($idCurso == $listaCurso['idCurso']) echo "selected";?>><?=$listaCurso['nome_curso']?></option>
      <?php } ?>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Disciplina</label>
    <select name="idDisciplina" id="" class="form-control">
      <option value="">Selecione uma Disciplina</option>
      <?php 
      $query = "SELECT * FROM disciplina ORDER BY nome_disciplina ASC";
      $disciplina = mysqli_query($conexao, $query);
      while($listaDisciplina = mysqli_fetch_assoc($disciplina)){ ?>
        <option value="<?=$listaDisciplina['idDisciplina'];?>" <?php if ($idDisciplina == $listaDisciplina['idDisciplina']) echo "selected";?>><?=$listaDisciplina['nome_disciplina']; ?></option>  
      <?php } ?>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Professor</label>
    <select name="idProfessor" id="" class="form-control">
    	<option value="">Selecione um Professor</option>    	
      <?php 
      $query = "SELECT * FROM professor ORDER BY nome_professor ASC";
      $professor = mysqli_query($conexao, $query);
      while($listaProfessor = mysqli_fetch_assoc($professor)){ ?>
        <option value="<?=$listaProfessor['idProfessor']; ?>" <?php if ($idProfessor == $listaProfessor['idProfessor']) echo "selected";?>><?=$listaProfessor['nome_professor']; ?></option>
      <?php } ?>
    </select>
  </div>
  <button type="submit" class="btn btn-success">Cadastrar</button>
</form>

<table class="table">
	<thead>
		<th>Nome do Curso</th>
    <th>Disciplina</th>
    <th>Professor</th>
		<th>Editar</th>
		<th>Excluir</th>
	</thead>

	<tbody>		
		<?php //Fazer listagem de cursos
    $query = "SELECT * FROM grade
    INNER JOIN disciplina ON grade.id_disciplina = disciplina.idDisciplina
    INNER JOIN professor ON grade.id_professor = professor.idProfessor
    INNER JOIN curso ON grade.id_curso = curso.idCurso
    ORDER BY nome_curso, nome_disciplina, nome_professor";		
		$resulGrade = mysqli_query($conexao, $query);
		while($lista = mysqli_fetch_assoc($resulGrade)){ ?>
      <tr>
    		<td><?=$lista['nome_curso']?></td>
        <td><?=$lista['nome_disciplina']?></td>
        <td><?=$lista['nome_professor']?></td>
        <td><a href="grade_form.php?id=<?=$lista['id_grade']?>"><button type="button" he class="btn btn-primary">Editar</button></a></td>
        <td><a href="excluir.php?tabela=grade&campo=id_grade&pagina=grade_form&id=<?=$lista['id_grade']?>"><button type="button" class="btn btn-danger">Excluir</button></a></td>
      </tr>
		<?php } ?>		
	</tbody>
</table>

<?php } else {
  header("Location: login_form.php");
} ?>

<?php require_once("footer.php"); ?>