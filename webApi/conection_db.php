<?php
	$servidor="localhost";
	$usuario="root";
	$clave="";
	$bd="ferreymas";
	$mysqli = new mysqli($servidor,$usuario,$clave,$bd) or die ("problemas con la conexion".mysql_error());

	if(mysqli_connect_errno()){
		echo 'conexion Fallida: ', mysqli_connect_error();
		exit();
	}

?>