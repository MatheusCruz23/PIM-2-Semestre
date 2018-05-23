<?php 
include("conexao.php"); 


if ($_POST['acao'] == 1) {	
	$query = " SELECT * FROM curso";
	
	$resultadoCurso = mysqli_query($conexao, $query);
	echo '<option value="">SELECIONAR CURSO</option>';
	while ($listaCurso = mysqli_fetch_assoc($resultadoCurso)) {
	    echo '<option value='.$listaCurso['idCurso'].'>'.$listaCurso['nome_curso'].'</option>';
	}
	
} else if($_POST['acao'] == 2) {
	
	$query = " SELECT disciplina.nome_disciplina, professor.nome_professor, 
			sala_info.bloco, sala_info.nome_sala, sala_info.andar FROM sala_local
			JOIN turma ON sala_local.id_turma = turma.idTurma
			JOIN grade ON sala_local.id_grade = grade.idGrade
			JOIN professor ON grade.id_professor = professor.idProfessor
			JOIN sala_info ON sala_local.id_sala = sala_info.idSala
			JOIN disciplina ON grade.id_disciplina = disciplina.idDisciplina
			WHERE turma.turma_nome = '".$_POST['nome_turma']."'";

	$resultadoTurma = mysqli_query($conexao, $query);
	$listaTurma = mysqli_fetch_assoc($resultadoTurma);
	
	if(count($listaTurma) <= 0){
		echo "<p>NÃO ENCONTRAMOS NENHUM RESULTADO, VERIFIQUE SUA TURMA E DIGITE NOVAMENTE</p>";
	} else {

		echo "<p>SALA: ".$listaTurma['bloco']." - ".$listaTurma['nome_sala']."</p>";	
		echo "<p>BLOCO: ".$listaTurma['bloco']."</p>";
		if ($listaTurma['andar'] == 1) {
			echo "<p>ANDAR: 2º ANDAR</p>";        
	    } elseif ($listaTurma['andar'] == 2) { 
			echo "<p>ANDAR: 1º ANDAR</p>";         
	    } elseif ($listaTurma['andar'] == 3) { 
	    	echo "<p>ANDAR: TERREO</p>";          
	    } elseif ($listaTurma['andar'] == 4) { 
	    	echo "<p>ANDAR: 1º SUBSOLO</p>";          
	    } elseif ($listaTurma['andar'] == 5) { 
	    	echo "<p>ANDAR: 2º SUBSOLO</p>";          
	    } else {
	    	echo "<p>ANDAR: 3º SUBSOLO</p>";          
	    } 

	    echo "<p>DISCIPLINA:".$listaTurma['nome_disciplina']."</p>";
	    echo "<p>BLOCO:".$listaTurma['nome_professor']."</p>";
	}
} else if ($_POST['acao'] == 3) {
	
	$query = " SELECT disciplina.nome_disciplina, professor.nome_professor, sala_info.bloco, 
			sala_info.nome_sala, sala_info.andar FROM sala_local";
	$query 	.="	JOIN turma ON sala_local.id_turma = turma.idTurma";
	$query	.=" JOIN grade ON sala_local.id_grade = grade.idGrade";
	$query	.="	JOIN professor ON grade.id_professor = professor.idProfessor";
	$query	.="	JOIN sala_info ON sala_local.id_sala = sala_info.idSala";
	$query	.="	JOIN disciplina ON grade.id_disciplina = disciplina.idDisciplina";
	$query	.="	WHERE sala_local.dia_semana = ".$_POST['dia']."";
	$query	.="	AND turma.semestre = ".$_POST['semestre']."";
	$query	.="	AND turma.periodo_turma = ".$_POST['periodo']."";
	$query	.="	AND grade.id_curso = ".$_POST['curso'];

	$resultadoTurma = mysqli_query($conexao, $query);	

	if(mysqli_num_rows($resultadoTurma) <= 0){
		echo "<p>NÃO ENCONTRAMOS NENHUM RESULTADO, VERIFIQUE AS OPÇÕES E CONSULTE NOVAMENTE</p>";
	} else {	

		while($listaConsulta = mysqli_fetch_assoc($resultadoTurma)){
						
		   	echo "<p>SALA: ".$listaConsulta['bloco']." - ".$listaConsulta['nome_sala']."</p>";	
			echo "<p>BLOCO: ".$listaConsulta['bloco']."</p>";
			if ($listaConsulta['andar'] == 1) {
				echo "<p>ANDAR: 2º ANDAR</p>";        
		    } elseif ($listaConsulta['andar'] == 2) { 
				echo "<p>ANDAR: 1º ANDAR</p>";         
		    } elseif ($listaConsulta['andar'] == 3) { 
		    	echo "<p>ANDAR: TERREO</p>";          
		    } elseif ($listaConsulta['andar'] == 4) { 
		    	echo "<p>ANDAR: 1º SUBSOLO</p>";          
		    } elseif ($listaConsulta['andar'] == 5) { 
		    	echo "<p>ANDAR: 2º SUBSOLO</p>";          
		    } else {
		    	echo "<p>ANDAR: 3º SUBSOLO</p>";          
		    } 

		    echo "<p>DISCIPLINA: ".$listaConsulta['nome_disciplina']."</p>";
		    echo "<p>BLOCO: ".$listaConsulta['nome_professor']."</p>"; 
		}		
	}
}
?>
