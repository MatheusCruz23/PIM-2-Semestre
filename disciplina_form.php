<?php require_once("header.php"); 
require_once("conexao.php");
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = "SELECT * FROM disciplina WHERE idDisciplina = $id";
	$resulEditar = mysqli_query($conexao, $query);
	$resultadoEditar = mysqli_fetch_assoc($resulEditar);

	$nome_disciplina = $resultadoEditar['nome_disciplina'];
} else {
	$nome_disciplina = '';
	$id = 0;
} 
if (isset($_SESSION['id_usuario'])) { ?>

<div class="titulo">
	<h2>Cadastrar Disciplina</h2>
</div>

<form action="disciplina_op.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Disciplina</label>
    <input type="hidden" name="id" value="<?=$id; ?>">
    <input type="text" value="<?=$nome_disciplina; ?>" name="nome_disciplina" class="form-control" id="exampleInputEmail1" placeholder="Nome da Disciplina" required>
  </div>
  <button type="submit" class="btn btn-success">Cadastrar</button>
</form>

<table class="table">
	<thead>
		<th>Nome da Disciplina</th>
		<th>Editar</th>
		<th>Excluir</th>
	</thead>
	<tbody>		
		<?php //Fazer listagem de cursos
		$query = "SELECT * FROM disciplina ORDER BY nome_disciplina ASC";
		$resulCurso = mysqli_query($conexao, $query);
		while($lista = mysqli_fetch_assoc($resulCurso)){ ?>
		<tr>
			<td><?=$lista['nome_disciplina']?></td>
			<td><a href="disciplina_form.php?id=<?=$lista['idDisciplina']?>"><button type="button" he class="btn btn-primary">Editar</button></a></td>
      		<td><a href="excluir.php?tabela=disciplina&campo=idDisciplina&pagina=disciplina_form&id=<?=$lista['idDisciplina']?>"><button type="button" class="btn btn-danger">Excluir</button></a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<?php } else {
	header("Location: login_form.php");
} ?>

<?php require_once("footer.php"); ?>