<?php require_once("header.php"); 
require_once("conexao.php");
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM sala_local 
    INNER JOIN turma ON sala_local.id_turma = turma.idTurma 
    INNER JOIN curso ON turma.id_curso = curso.idCurso
    INNER JOIN sala_info ON sala_local.id_sala = sala_info.idSala 
    INNER JOIN tipo_sala ON sala_info.id_tipo_sala = tipo_sala.idTipoSala
    INNER JOIN grade ON sala_local.id_grade = grade.idGrade 
    INNER JOIN disciplina ON grade.id_disciplina = disciplina.idDisciplina 
    INNER JOIN professor ON grade.id_professor = professor.idProfessor  
    WHERE idLocal = $id";
  $infoSalaLocal = mysqli_query($conexao, $query);
  $editarSalaLocal = mysqli_fetch_assoc($infoSalaLocal);

  $id_turma = $editarSalaLocal['id_turma'];
  $idSala = $editarSalaLocal['id_sala'];
  $id_grade = $editarSalaLocal['id_grade'];
  $nome_curso = $editarSalaLocal['nome_curso'];
  $nome_tipo = $editarSalaLocal['nome_tipo'];
  $nome_sala = $editarSalaLocal['nome_sala'];
  $nome_disciplina = $editarSalaLocal['nome_disciplina'];
  $bloco = $editarSalaLocal['bloco'];
  $andar = $editarSalaLocal['andar'];
  $dia_semana = $editarSalaLocal['dia_semana'];
  $periodo_local = $editarSalaLocal['periodoLocal'];
  $semestre = $editarSalaLocal['semestre'];
  $periodo_turma = $editarSalaLocal['periodo_turma'];
} else {
  $id = 0;
  $id_turma = '';
  $idSala = '';
  $id_grade = '';
  $nome_curso = '';
  $nome_tipo = '';
  $nome_sala = '';
  $nome_disciplina = '';
  $bloco = '';
  $andar = '';
  $dia_semana = '';
  $periodo_local = '';
  $semestre = '';
  $periodo_turma = '';
} 

if (isset($_SESSION['id_usuario'])) { ?>

<div class="titulo">
	<h2>Cadastrar Turma em Sala</h2>
</div>

<form action="turmaSala_op.php" method="post">
  <input type="hidden" name="id" value="<?=$id?>">
  <div class="form-group">
    <label for="exampleInputEmail1">Escolha a Turma</label>
    <select name="id_turma" id="id_turma" class="form-control" required>
    <option value="">Selecione a Turma</option>
      <?php
      $query = "SELECT turma.*, curso.* FROM turma 
      LEFT JOIN curso ON turma.id_curso = curso.idCurso 
      ORDER BY nome_curso, semestre ASC";
      $turma = mysqli_query($conexao, $query);
      while($listaTurma = mysqli_fetch_assoc($turma)){
        if($listaTurma['periodo_turma'] == 1){ ?>
          <option value="<?=$listaTurma['id_turma']?>" <?php if ($id_turma == $listaTurma['id_turma']) echo "selected";?>><?=$listaTurma['nome_curso']?> - MANHÃ - <?=$listaTurma['semestre']; ?>º Semestre</option>
        <?php } elseif ($listaTurma['periodo_turma'] == 2) { ?>
          <option value="<?=$listaTurma['id_turma']?>" <?php if ($id_turma == $listaTurma['id_turma']) echo "selected";?>><?=$listaTurma['nome_curso']?> - TARDE - <?=$listaTurma['semestre']; ?>º Semestre</option>
        <?php } else { ?>
          <option value="<?=$listaTurma['idTurma']?>" <?php if ($id_turma == $listaTurma['idTurma']) echo "selected";?>><?=$listaTurma['nome_curso']?> - NOITE - <?=$listaTurma['semestre']; ?>º Semestre</option>
        <?php }
      } ?>      
    </select>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Sala</label>
    <select name="idSala" id="" class="form-control">
      <option value="">Selecione a Sala</option>
    	<?php 
      $query = "SELECT sala_info.*, tipo_sala.* FROM sala_info 
      INNER JOIN tipo_sala ON sala_info.id_tipo_sala = tipo_sala.idTipoSala 
      ORDER BY nome_sala ASC";
      $sala = mysqli_query($conexao, $query);
      while ($listaSala = mysqli_fetch_assoc($sala)) {
        switch ($listaSala['andar']) {
           case 1: ?>
             <option value="<?=$listaSala['idSala'];?>" <?php if ($idSala == $listaSala['idSala']) echo "selected";?>><?=$listaSala['nome_tipo'] ?> - BLOCO <?=$listaSala['bloco']; ?> - <?=$listaSala['nome_sala']?> - 2º ANDAR</option>
            <?php break;

            case 2: ?>
             <option value="<?=$listaSala['idSala'];?>" <?php if ($idSala == $listaSala['idSala']) echo "selected";?>><?=$listaSala['nome_tipo'] ?> - BLOCO <?=$listaSala['bloco']; ?> - <?=$listaSala['nome_sala']?> - 1º ANDAR</option>
            <?php break;

            case 3: ?>
             <option value="<?=$listaSala['idSala'];?>" <?php if ($idSala == $listaSala['idSala']) echo "selected";?>><?=$listaSala['nome_tipo'] ?> - BLOCO <?=$listaSala['bloco']; ?> - <?=$listaSala['nome_sala']?> - TERREO</option>
            <?php break;

            case 4: ?>
             <option value="<?=$listaSala['idSala'];?>" <?php if ($idSala == $listaSala['idSala']) echo "selected";?>><?=$listaSala['nome_tipo'] ?> - BLOCO <?=$listaSala['bloco']; ?> - <?=$listaSala['nome_sala']?> - 1º SUBSOLO</option>
            <?php break;

            case 5: ?>
             <option value="<?=$listaSala['idSala'];?>" <?php if ($idSala == $listaSala['idSala']) echo "selected";?>><?=$listaSala['nome_tipo'] ?> - BLOCO <?=$listaSala['bloco']; ?> - <?=$listaSala['nome_sala']?> - 2º SUBSOLO</option>
            <?php break;
           
           default: ?>
             <option value="<?=$listaSala['idSala'];?>" <?php if ($idSala == $listaSala['idSala']) echo "selected";?>><?=$listaSala['nome_tipo'] ?> - BLOCO <?=$listaSala['bloco']; ?> - <?=$listaSala['nome_sala']?> - 3º SUBSOLO</option>
            <?php break;
        }          
      } ?>
    </select>
  </div>

  <!-- O campo com os nomes da disciplina é mostrada abaixo de acordo com a turma escolhida -->
  <div class="form-group">
    <label for="exampleInputEmail1">Disciplina</label>
    <select name="id_grade" id="option" class="form-control">
      <option value="">Selecione a Disciplina</option>
      
      <?php 
      $query = "SELECT grade.*, disciplina.*, professor.* FROM grade 
      INNER JOIN disciplina ON grade.id_disciplina = disciplina.idDisciplina 
      INNER JOIN professor ON grade.id_professor = professor.idDisciplina
      ORDER BY nome_disciplina ASC";
      $disciplina = mysqli_query($conexao, $query);
      while ($listaDisciplina = mysqli_fetch_assoc($disciplina)) { ?>
           <option value="<?=$listaDisciplina['id_grade']; ?>" <?php if ($id_grade == $listaDisciplina['id_grade']) echo "selected"; ?>><?=$listaDisciplina['nome_disciplina']; ?> - <?=$listaDisciplina['nome_professor']; ?></option>
      <?php } ?>            
    	<script>
        //Pega a turma escolhida e faz a busca da disciplina
        $("#id_turma").change(function() {
         $.ajax({url: "ajax.php?id="+$('#id_turma :selected').val(),
            success: function(result){
              $('#option').html(result);
            }});
        });


      </script>   	
    </select>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Dia da Semana</label>
    <select name="dia_semana" id="" class="form-control" required>
      <option value="">Escolha um dia da Semana</option>
      <option name="dia_semana" value="1" <?php if ($dia_semana == 1) echo "selected";?>>SEGUNDA-FEIRA</option>
      <option name="dia_semana" value="2" <?php if ($dia_semana == 2) echo "selected";?>>TERÇA-FEIRA</option>  
      <option name="dia_semana" value="3" <?php if ($dia_semana == 3) echo "selected";?>>QUARTA-FEIRA</option>  
      <option name="dia_semana" value="4" <?php if ($dia_semana == 4) echo "selected";?>>QUINTA-FEIRA</option>  
      <option name="dia_semana" value="5" <?php if ($dia_semana == 5) echo "selected";?>>SEXTA-FEIRA</option>
      <option name="dia_semana" value="6" <?php if ($dia_semana == 6) echo "selected";?>>SABADO</option>    
    </select>
  </div>

  <div class="form-group">
    <label class="radio_inline">Periodo</label>
    <label class="radio-inline">
      <input type="radio" name="periodo_local" id="inlineRadio1" value="1" <?php if ($periodo_local == 1) echo "checked";?>> Manhã
    </label>
    <label class="radio-inline">
      <input type="radio" name="periodo_local" id="inlineRadio2" value="2" <?php if ($periodo_local == 2) echo "checked";?>> Tarde
    </label>
    <label class="radio-inline">
      <input type="radio" name="periodo_local" id="inlineRadio3" value="3" <?php if ($periodo_local == 3) echo "checked";?>> Noite
    </label>
  </div>
  <button type="submit" class="btn btn-success">Cadastrar</button>
</form>

<table class="table">
	<thead>
		<th>Curso</th>
    <th>Periodo</th>
    <th>Semestre</th>
    <th>Bloco</th>
    <th>Sala</th>    
    <th>Andar</th>
    <th>Disciplina</th>
    <th>Dia</th>
    <th>Periodo Sala</th>
		<th>Editar</th>
		<th>Excluir</th>
	</thead>
	<tbody>
		<?php

    //Fazer a consulta da grade para trazer a lista das informações cadastrada
    $query = "SELECT * FROM sala_local 
          INNER JOIN turma ON sala_local.id_turma = turma.idTurma 
          INNER JOIN curso ON turma.id_curso = curso.idCurso
          INNER JOIN sala_info ON sala_local.id_sala = sala_info.idSala 
          INNER JOIN tipo_sala ON sala_info.id_tipo_sala = tipo_sala.idTipoSala
          INNER JOIN grade ON sala_local.id_grade = grade.idGrade 
          INNER JOIN disciplina ON grade.id_disciplina = disciplina.idDisciplina 
          INNER JOIN professor ON grade.id_professor = professor.idProfessor 
          ORDER BY nome_curso, semestre ASC";

		$resulSalaLocal = mysqli_query($conexao, $query);
		while($lista = mysqli_fetch_assoc($resulSalaLocal)){ ?>
      <tr>
  		  <td><?=$lista['nome_curso']?></td>

        <?php if ($lista['periodo_turma'] == 1) { ?>
          <td>MANHÃ</td>
        <?php } elseif ($lista['periodo_turma'] == 2) { ?>
          <td>TARDE</td>
        <?php } else { ?>
          <td>NOITE</td>
        <?php } ?>

        <td><?=$lista['semestre']?>ºSEMESTRE</td>
        <td><?=$lista['bloco']?></td>
        <td><?=$lista['nome_sala']?></td> 

        <?php if ($lista['andar'] == 1) { ?>
          <td>2º ANDAR</td>
        <?php } elseif ($lista['andar'] == 2) { ?>
          <td>1º ANDAR</td>
        <?php } elseif ($lista['andar'] == 3) { ?>
          <td>TERREO</td>
        <?php } elseif ($lista['andar'] == 4) { ?>
          <td>1º SUBSOLO</td>
        <?php } elseif ($lista['andar'] == 5) { ?>
          <td>2º SUBSOLO</td>
        <?php } else { ?>
          <td>3º SUBSOLO</td>
        <?php } ?>               
        
        <td><?=$lista['nome_disciplina']?></td>

        <?php switch ($lista['dia_semana']) {
          case 1: ?>
            <td>SEGUNDA-FEIRA</td>
          <?php break;

          case 2: ?>
            <td>TERÇA-FEIRA</td>
          <?php break;

          case 3: ?>
            <td>QUARTA-FEIRA</td>
          <?php break;

          case 4: ?>
            <td>QUINTA-FEIRA</td>
          <?php break;

          case 5: ?>
            <td>SEXTA-FEIRA</td>
          <?php break;

          case 6: ?>
            <td>SABADO</td>
          <?php break;
          
          default: ?>
            <td>Error</td>
          <?php break;
        }

        switch ($lista['periodoLocal']) {
           case 1: ?>
             <td>MANHÃ</td>
            <?php break;

            case 2: ?>
             <td>TARDE</td>
            <?php break;
           
           default: ?>
             <td>NOITE</td>
            <?php break;
         } ?>

        <td><a href="turmaSala_form.php?id=<?=$lista['idLocal']?>"><button type="button" he class="btn btn-primary">Editar</button></a></td>
        <td><a href="excluir.php?tabela=sala_local&campo=id_sala_local&pagina=turmaSala_form&id=<?=$lista['id_sala_local']?>"><button type="button" class="btn btn-danger">Excluir</button></a></td>
      </tr>
		<?php } ?>
	</tbody>
</table>

<?php } else {
  header("Location: login_form.php");
} ?>

<?php require_once("footer.php"); ?>