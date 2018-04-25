<?php require_once("header.php");
require_once("conexao.php");

$id = $_GET["id"];
$tabela = $_GET["tabela"];
$campo = $_GET["campo"];
$pagina = $_GET["pagina"];

$query = "DELETE FROM $tabela WHERE $campo = $id";
mysqli_query($conexao, $query);

header("Location: $pagina.php");