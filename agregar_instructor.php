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

	$programs = mysql_query("SELECT id, name FROM Program") or die ('ERROR PROGRAMS: ' . mysql_error());	

	$staff = mysql_query("SELECT id, name FROM Staff") or die ('ERROR STAFF: ' . mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet">
<title>University Accomodations</title>
</head>

<body>
<?php include_once('barra.php') ?>
			<div id="instructor">
            <form method="post" action="insertar_instructor.php"> 
                <fieldset id="forma_alumno">
          			<legend>Instructor Information</legend>
					Instructor ID: <input name="instructorID" type="text"/><br />
                    Name: <input name="name" type="text"/><br />
                    Phone Number: <input name="phone" type="text"/><br />
                    Email: <input name="email" type="text"/><br />
                    Room Number: <input name="roomNumber" type="text"/><br />
                    Department Number: <input name="dNumber" type="text"/><br />
                    <input class="form_button" type="submit" value="Submit">
                </fieldset>
            </form>
            </div>
</body>
</html>
