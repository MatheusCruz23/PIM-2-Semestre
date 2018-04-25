<?php require_once("header.php"); 
require_once("conexao.php");

if (!isset($_SESSION['id_usuario'])) { ?>
<div class="login">
	<form action="login_op.php?acao=autentica" method="post">
	  <div class="form-group">
	    <label for="exampleInputEmail1">Email</label>
	    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">Senha</label>
	    <input type="password" name="senha" class="form-control" id="exampleInputPassword1" placeholder="Password">
	  </div>  
	  <button type="submit" class="btn btn-default">ENTRAR</button>
	</form>
</div>
<?php } else { 
	header("Location: index.php");
}

require_once("footer.php"); ?>