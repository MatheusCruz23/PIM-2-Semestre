<?php require_once("header.php");
require_once("conexao.php");
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT sala_info.*, tipo_sala.* FROM sala_info INNER JOIN tipo_sala ON tipo_sala.id_tipo_sala = sala_info.id_tipo_sala WHERE id_sala = $id";
  $editarSala = mysqli_query($conexao, $query);
  $resul = mysqli_fetch_assoc($editarSala);

  $id_tipo_sala = $resul['id_tipo_sala'];
  $bloco = $resul['bloco'];
  $nome_sala = $resul['nome_sala'];
  $nome_tipo = $resul['nome_tipo'];
  $andar = $resul['andar'];
} else {
  $id = 0;
  $id_tipo_sala = '';
  $bloco = '';
  $nome_tipo = '';
  $nome_sala = '';
  $andar = '';
} 

if (isset($_SESSION['id_usuario'])) { ?>

<div class="titulo">
	<h2>Cadastrar Sala</h2>
</div>

<form action="sala_op.php" method="post">
  <input type="hidden" value="<?=$id?>" name="id">
  <div class="form-group">
    <label for="exampleInputEmail1">Bloco da Sala</label>
    <input type="text" value="<?=$bloco?>" name="bloco" class="form-control" id="exampleInputEmail1" placeholder="Bloco da Sala" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Sala</label>
    <input type="text" value="<?=$nome_sala?>" name="nome_sala" class="form-control" id="exampleInputEmail1" placeholder="Digite a Sala" required>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Andar</label>
    <select name="andar" id="" class="form-control">
    	<option value="1" <?php if ($andar == 1) echo "selected";?>>2º ANDAR</option>
      <option value="2" <?php if ($andar == 2) echo "selected";?>>1º ANDAR</option>
      <option value="3" <?php if ($andar == 3) echo "selected";?>>TÉRREO</option>
      <option value="4" <?php if ($andar == 4) echo "selected";?>>1º SUBSOLO</option>
      <option value="5" <?php if ($andar == 5) echo "selected";?>>2º SUBSOLO</option>
      <option value="6" <?php if ($andar == 6) echo "selected";?>>3º SUBSOLO</option>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Tipo da Sala</label>
    <select name="id_tipo_sala" id="" class="form-control">
    	<option value="">Selecione o Tipo da Sala</option>
      <?php 
      $query = "SELECT * FROM tipo_sala ORDER BY nome_tipo ASC";
      $resultadoTipoSala = mysqli_query($conexao, $query);
      while ($listaTipoSala = mysqli_fetch_assoc($resultadoTipoSala)) { ?>
        <option value="<?=$listaTipoSala['id_tipo_sala']?>" <?php if ($id_tipo_sala == $listaTipoSala['id_tipo_sala']) echo "selected";?>><?=$listaTipoSala['nome_tipo']?></option>
      <?php } ?>
    </select>
  </div>

  <div class="form-group">
    <label for="">Capacidade de alunos</label>
    <input type="number" class="form-control">
  </div>

  <button type="submit" class="btn btn-success">Cadastrar</button>
</form>

<table class="table">
	<thead>
		<th>Bloco</th>
    <th>Sala</th>
    <th>Andar</th>
    <th>Tipo Sala</th>
    <th>Capacidade</th>
		<th>Editar</th>
		<th>Excluir</th>
	</thead>

	<tbody>		
		<?php //Fazer listagem de cursos
    $query = "SELECT * FROM sala_info si
            INNER JOIN tipo_sala ts ON si.id_tipo_sala = ts.idTipoSala
            ORDER BY bloco, nome_sala";		
		$resultadoSala = mysqli_query($conexao, $query);
		while($listaSala = mysqli_fetch_assoc($resultadoSala)){ ?>
    <tr>
		  <td><?=$listaSala['bloco']?></td>
      <td><?=$listaSala['nome_sala']?></td>
      <?php switch ($listaSala['andar']) {
        case 1: ?>
          <td>2º ANDAR</td>
        <?php break;

        case 2: ?>
          <td>1º ANDAR</td>
        <?php break;

        case 3: ?>
          <td>TÉRREO</td>
        <?php break;

        case 4: ?>
          <td>1º SUBSOLO</td>
        <?php break;

        case 5: ?>
          <td>2º SUBSOLO</td>
        <?php break;
        
        default: ?>
          <td>3º SUBSOLO</td>
        <?php break;
      } ?>
      <td><?=$listaSala['nome_tipo']?></td>
      <td><a href="sala_form.php?id=<?=$listaSala['id_sala']?>"><button type="button" he class="btn btn-primary">Editar</button></a></td>
      <td><a href="excluir.php?tabela=sala_info&campo=id_sala&pagina=sala_form&id=<?=$listaSala['id_sala']?>"><button type="button" class="btn btn-danger">Excluir</button></a></td>
    </tr>
		<?php } ?>
	</tbody>
</table>

<?php } else {
  header("Location: login_form.php");
} ?>

<?php require_once("footer.php"); ?>