<?php 
ob_start();
session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/estilo.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>	
<div class="container box">
	<header>
		<h1>Cadastrar Sala</h1>
	</header>
	<?php if (isset($_SESSION['id_usuario'])) { ?>		
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>	      
	    </div>
	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">	       	
		  	<li role="presentation"><a href="turmaSala_form.php">Turma nas salas</a></li>
		  	<li role="presentation"><a href="grade_form.php">Montar Grade</a></li>
		  	<li role="presentation"><a href="sala_form.php">Sala</a></li>		  	
		  	<li role="presentation"><a href="turma_form.php">Turma</a></li>
		  	<li role="presentation"><a href="professor_form.php">Professor</a></li>
		  	<li role="presentation"><a href="disciplina_form.php">Disciplina</a></li>
		  	<li role="presentation"><a href="curso_form.php">Curso</a></li>
		  	<li role="presentation" class="active"><a href="login_op.php?acao=deslogar">Sair</a></li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	<?php } ?>
	<article>