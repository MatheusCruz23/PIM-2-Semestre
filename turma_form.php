<?php require_once("header.php"); 
require_once("conexao.php");
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT turma.*, curso.* FROM turma INNER JOIN curso ON turma.id_curso = curso.idCurso WHERE idTurma = $id";
  $resulEditar = mysqli_query($conexao, $query);
  $resultadoEditar = mysqli_fetch_assoc($resulEditar);

  $idCurso = $resultadoEditar['id_curso'];
  $nome_curso = $resultadoEditar['nome_curso'];
  $periodo_turma = $resultadoEditar['periodo_turma'];
  $semestre = $resultadoEditar['semestre'];
  $qnto_aluno = $resultadoEditar['qnto_aluno'];
  $turma_nome = $resultadoEditar['turma_nome'];
} else {
  $id = 0;
  $idCurso = '';
  $nome_curso = '';
  $periodo_turma = '';
  $semestre = '';
  $qnto_aluno = '';
  $turma_nome = '';
} 

if (isset($_SESSION['id_usuario'])) { ?>

<div class="titulo">
	<h2>Cadastrar Turma</h2>
</div>

<form action="turma_op.php" method="post">
  <input type="hidden" name="id" value="<?=$id; ?>">
  <div class="form-group">
    <label for="exampleInputEmail1">Curso</label>
    <select name="id_curso" id="" class="form-control" required>    
    	<option value="">Selecione o Curso</option>
      <?php
      $query = "SELECT * FROM curso ORDER BY nome_curso ASC";
      $resulCurso = mysqli_query($conexao, $query);
       while($listaCurso = mysqli_fetch_assoc($resulCurso)){ ?>
        <option value="<?=$listaCurso['idCurso']; ?>" <?php if ($idCurso == $listaCurso['idCurso']) echo "selected";?>><?=$listaCurso['nome_curso'];?></option>
      <?php } ?>
    </select>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Periodo</label>
    <select name="periodo_turma" id="" class="form-control" required>
    	<option value="">Selecione o Peirodo</option>
    	<option value="1" <?php if ($periodo_turma == 1) echo "selected";?>>MANHÃ</option>
    	<option value="2" <?php if ($periodo_turma == 2) echo "selected";?>>TARDE</option>
    	<option value="3" <?php if ($periodo_turma == 3) echo "selected";?>>NOITE</option>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Semestre</label>
    <select name="semestre" id="" class="form-control" required>
    	<option value="">Selecione o Semestre</option>
    	<option value="1" <?php if ($semestre == 1) echo "selected";?>>1º SEMESTRE</option>
    	<option value="2" <?php if ($semestre == 2) echo "selected";?>>2º SEMESTRE</option>
    	<option value="3" <?php if ($semestre == 3) echo "selected";?>>3º SEMESTRE</option>
    	<option value="4" <?php if ($semestre == 4) echo "selected";?>>4º SEMESTRE</option>
    	<option value="5" <?php if ($semestre == 5) echo "selected";?>>5º SEMESTRE</option>
    	<option value="6" <?php if ($semestre == 6) echo "selected";?>>6º SEMESTRE</option>
    	<option value="7" <?php if ($semestre == 7) echo "selected";?>>7º SEMESTRE</option>
    	<option value="8" <?php if ($semestre == 8) echo "selected";?>>8º SEMESTRE</option>
    	<option value="9" <?php if ($semestre == 9) echo "selected";?>>9º SEMESTRE</option>
    	<option value="10" <?php if ($semestre == 10) echo "selected";?>>10º SEMESTRE</option>
    </select>
  </div>

  <div class="form-group">
    <label for="">Turma:</label>
    <input type="text" class="form-control" name="turma_nome" value="<?=$turma_nome?>">
  </div>

  <div class="form-group">
    <label for="">Alunos</label>
    <input type="number" class="form-control" name="qnto_aluno" value="<?=$qnto_aluno?>">
  </div>

  <button type="submit" class="btn btn-success">Cadastrar</button>
</form>

<table class="table">
	<thead>
		<th>Nome do Curso</th>
    <th>Periodo</th>
    <th>Semestre</th>
    <th>Quantidade</th>
    <th>Turma</th>
		<th>Editar</th>
		<th>Excluir</th>
	</thead>
	<tbody>		
		<?php //Fazer listagem de cursos
		$query = "SELECT turma.*, curso.* FROM turma INNER JOIN curso ON turma.id_curso = curso.idCurso ORDER BY nome_curso, semestre ASC";
		$resulCurso = mysqli_query($conexao, $query);
		while($lista = mysqli_fetch_assoc($resulCurso)){ ?>
    <tr>
		  <td><?=$lista['nome_curso']?></td>
      
      <?php switch ($lista['periodo_turma']) {
        case 1: ?>
          <td>MANHÃ</td>
        <?php break;

        case 2: ?>
          <td>TARDE</td>
        <?php break;

        case 3: ?>
          <td>NOITE</td>
        <?php break;
        
        default: ?>
          <td>SEM PERIODO</td>
        <?php break;
      } ?>

      <td><?=$lista['semestre']?>º SEMESTRE</td>
      
      <td><?=$lista['qnto_aluno']?></td>

      <td><?=$lista['turma_nome']?></td>

      <td><a href="turma_form.php?id=<?=$lista['idTurma']?>"><button type="button" he class="btn btn-primary">Editar</button></a></td>
      <td><a href="excluir.php?tabela=turma&campo=idTurma&pagina=turma_form&id=<?=$lista['idTurma']?>"><button type="button" class="btn btn-danger">Excluir</button></a></td>
    </tr>
		<?php } ?>		
	</tbody>
</table>

<?php } else {
  header("Location: login_form.php");
} ?>

<?php require_once("footer.php"); ?>