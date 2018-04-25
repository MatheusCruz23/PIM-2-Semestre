<?php require_once("header.php");
require_once("conexao.php"); 
if (isset($_SESSION['id_usuario'])) {
	header("Location: turmaSala_form.php");
} else {
	header("Location: login_form.php");
}

require_once("footer.php"); ?>