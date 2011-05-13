<?php

	include_once('connectvars.php');
	$conexion =  mysql_connect(host, user, password);
	//Se establece el charset para la conexion
	mysql_set_charset('utf8',$conexion);

	//Verificando que la conexion con el servidor con mysql se haya realizado con exito
	if (!$conexion) {
		die('No pudo conectarse: ' . mysql_error());
	}
	//Abrir base de datos
	$conexion_base = mysql_select_db(db, $conexion);

	//Verificando que la conexion se haya hecho a la BD
	if (!$conexion_base) {
		die ('No se encuentra la base de datos seleccionada : ' . mysql_error());
	}
	
	$instructorID = $_POST['instructorID'];
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$roomNumber = $_POST['roomNumber'];
	$dNumber = $_POST['dNumber'];
	

	$instructor = mysql_query("INSERT INTO Instructor VALUES ('$instructorID', '$name', '$phone', '$email', '$roomNumber', '$dNumber')")
	or die('Error inserting: ' . mysql_error());
	
	header("Location: confirmacion.php");
?>
