<?php
$host_name='localhost';
$database_username='root';
$database_password='';
$database_name='clinica';

$conn= mysqli_connect($host_name, $database_username, $database_password, $database_name);

if (!$conn){
	die('Erro de ligação à base de dados!' .mysql_error);
}
?>

