<?php require_once("header.php"); 
require_once("conexao.php");

if ($_GET['acao'] == 'autentica') {
	$email=$_POST['email'];
	$senha=$_POST['senha'];

	$query="SELECT * FROM usuario_adm WHERE email='".$_POST['email']."' and senha='".$_POST['senha']."'";
	$usuario_adm=mysqli_query($conexao, $query);
	$autoriza_usuario=mysqli_fetch_assoc($usuario_adm);
	if (count($autoriza_usuario)>=1) {
		$_SESSION['id_usuario']=$autoriza_usuario['id_usuario'];
		$_SESSION['email']=$autoriza_usuario['email'];

		echo "<script>
		alert('Login realizado com sucesso');
		window.location.href='index.php'
	</script>";


} else {
	echo "<script>
	alert('Login invalido');
	window.location.href='index.php'
</script>";
} } else if  ($_GET['acao'] == 'deslogar') {

	unset($_SESSION['id_usuario']);
	unset($_SESSION['email']);

			echo "<script>
		alert('Deslogado com sucesso');
		window.location.href='index.php'
	</script>";
}

?>