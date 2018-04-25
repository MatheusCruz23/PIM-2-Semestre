<?php require_once("header.php"); 
require_once("conexao.php");
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = "SELECT * FROM curso WHERE id_curso = $id";
	$resulEditar = mysqli_query($conexao, $query);
	$resultadoEditar = mysqli_fetch_assoc($resulEditar);

	$nome_curso = $resultadoEditar['nome_curso'];
} else {
	$nome_curso = '';
	$id = 0;
} 

if (isset($_SESSION['id_usuario'])) { ?>

<div class="titulo">
	<h2>Cadastrar Curso</h2>
</div>

<form action="curso_op.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Nome do Curso</label>
    <input type="hidden" name="id" value="<?=$id; ?>">
    <input type="text" value="<?=$nome_curso; ?>" name="nome_curso" class="form-control" id="exampleInputEmail1" placeholder="Nome do Curso" required>
  </div>
  <button type="submit" class="btn btn-success">Cadastrar</button>
</form>

<table class="table table-hover">
	<thead>
		<th>Nome do Curso</th>
		<th>Editar</th>
		<th>Excluir</th>
	</thead>
	<tbody>
		<?php //Fazer listagem de cursos
		$query = "SELECT * FROM curso ORDER BY nome_curso ASC";
		$resulCurso = mysqli_query($conexao, $query);
		while($lista = mysqli_fetch_assoc($resulCurso)){ ?>
			<tr>			
				<td><?=$lista['nome_curso']?></td>
				<td><a href="curso_form.php?id=<?=$lista['id_curso']?>"><button type="button" he class="btn btn-primary">Editar</button></a></td>
				<td><a href="excluir.php?tabela=curso&campo=id_curso&pagina=curso_form&id=<?=$lista['id_curso']?>"><button type="button" class="btn btn-danger">Excluir</button></a></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php } else {
	header("Location: login_form.php");
} ?>

<?php require_once("footer.php"); ?>