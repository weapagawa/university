<?php
	
	function begin() {
	
		@mysql_query("BEGIN");
	}
	
	function commit() {
	
		@mysql_query("COMMIT");
	}
	
	function rollback()	{
	
		@mysql_query("ROLLBACK");
	}
	
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
	
	$lNumber = $_POST['leaseNum'];
	$sDate = $_POST['sDate'];
	$eDate = $_POST['eDate'];
	$duration = $_POST['duration'];
	$studentID = $_POST['student'];
	$placeNum = $_POST['room'];
	

	$contrato = "INSERT INTO Lease VALUES ('$lNumber', '$sDate', '$eDate', '$duration', '$studentID', '$placeNum')";
	begin(); // Empieza la transaccion
	$result = mysql_query($contrato);
	
	if(!$result) {
		
		rollback(); // Si hubo un error se le da rollback
		echo 'Hubo un error';
		exit;
	}
	
	else {
		commit(); //Si fue exitosa se lleva a cabo
		echo 'Operación realizada con éxito';
	}
	
	
	header("Location: confirmacion.php");
?>
