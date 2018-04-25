<?php require_once("header.php"); 
require_once("conexao.php");
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = "SELECT * FROM professor WHERE idProfessor = $id";
	$resulEditar = mysqli_query($conexao, $query);
	$resultadoEditar = mysqli_fetch_assoc($resulEditar);

	$nome_professor = $resultadoEditar['nome_professor'];
} else {
	$id = 0;
	$nome_professor = '';
} 

if (isset($_SESSION['id_usuario'])) { ?>

<div class="titulo">
	<h2>Cadastrar Professor</h2>
</div>

<form action="professor_op.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Nome do Professor</label>
    <input type="hidden" name="id" value="<?=$id;?>">
    <input type="text" value="<?=$nome_professor;?>" name="nome_professor" class="form-control" id="exampleInputEmail1" placeholder="Nome do Professor" required>
  </div>
  <button type="submit" class="btn btn-success">Cadastrar</button>
</form>

<table class="table">
	<thead>
		<th>Nome do Professor</th>
		<th>Editar</th>
		<th>Excluir</th>
	</thead>
	<tbody>		
		<?php //Fazer listagem de cursos
		$query = "SELECT * FROM professor";
		$resulProfessor = mysqli_query($conexao, $query);
		while($lista = mysqli_fetch_assoc($resulProfessor)){ ?>
			<tr>
				<td><?=$lista['nome_professor']?></td>
				<td><a href="professor_form.php?id=<?=$lista['idProfessor']?>"><button type="button" he class="btn btn-primary">Editar</button></a></td>
        		<td><a href="excluir.php?tabela=professor&campo=idProfessor&pagina=professor_form&id=<?=$lista['idProfessor']?>"><button type="button" class="btn btn-danger">Excluir</button></a></td>
			</tr>
		<?php } ?>		
	</tbody>
</table>

<?php } else {
	header("Location: login_form.php");
} ?>

<?php require_once("footer.php"); ?>