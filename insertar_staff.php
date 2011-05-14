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
	
	$id = $_POST['staffID'];
	$name = $_POST['name'];
	$position = $_POST['position'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$postcode = $_POST['postcode'];
	$roomnNumber = $_POST['room_number'];
	$dnumber = $_POST['d_number'];
	
		
			
	$staff = mysql_query("INSERT INTO Staff VALUES ('$id', '$name', '$position', '$phone', '$email', '$roomnNumber', '$dnumber')") 
	or die('Error inserting: '. mysql_error());
	
	header("Location: confirmacion.php");
?>
