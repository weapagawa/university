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
	
	$studentID = $_POST['studentID'];
	$fname = $_POST['first_name'];
	$lname = $_POST['last_name'];
	$street = $_POST['street'];
	$city = $_POST['city'];
	$postcode = $_POST['postcode'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$b_date = $_POST['b_date'];
	$sex = $_POST['sex'];
	$category = $_POST['category'];
	$nationality = $_POST['nationality'];
	$special_needs = $_POST['special_needs'];
	$comments = $_POST['comments'];
	$status = $_POST['status'];
	$major = $_POST['major'];
	$minor = $_POST['minor'];
	$nokID = $_POST['nokID'];
	$nokName = $_POST['nokName'];
	$nokAddr = $_POST['nokAddr'];
	$nokPhone = $_POST['nokPhone'];
	$programID = $_POST['program'];
	$advisorID = $_POST['advisor'];
	
	//list($day, $month, $year) = explode("/", $b_date);
	//$date = $year."-".$month."-".$day;

	$noK = mysql_query("INSERT INTO Nextofkin VALUES('$nokID','$nokName','$nokAddr','$nokPhone')") or die('Error inserting: ' .
	mysql_error());
	
	$alumno = mysql_query("INSERT INTO Student VALUES ('$studentID', '$fname', '$lname', '$street', '$city', '$postcode', '$phone',"
	. "'$email', '$b_date', '$sex', '$category', '$nationality', '$special_needs', '$comments', '$status', '$major', '$minor',"
	. "'$nokID', '$programID', '$advisorID')") or die('Error inserting: '. mysql_error());
	
	header("Location: confirmacion.php");
?>
