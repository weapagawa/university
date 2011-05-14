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

	$dept = mysql_query("SELECT dnumber, dname FROM Department") or die ('ERROR DEPARTMENTS: ' . mysql_error());
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
			<div id="alumno">
            <form method="post" action="insertar_staff.php"> 
                <fieldset>
          			<legend>Student Information</legend>
					Staff ID: <input name="staffID" type="text"/><br />
                    Name: <input name="name" type="text"/><br />
                    Position: <input name="position" type="text" /><br />
					Phone: <input name="phone" type="text"/><br />
                    Email: <input name="email" type="text"/><br />
                    Room Number: <input name="room_number" type="text"/><br />
                     Department Number: <select name="dNumber">
		                    <!--Se revisa si hay por lo menos una fila de resultados-->
		                    <?php if (mysql_num_rows($dept) > 0) {?>
		                    <option selected="selected" value="null">Choose a department</option>
		                    <?php
		                            while($row = mysql_fetch_array($dept))
		                            {
		                                echo "<option value=".$row['dnumber'].">".$row['dname']."</option>";
		                            } 
		                        } else {
		                        echo "<option value=\"null\">There are no programs</option>";
		                     }                
		                    ?>        	
                    </select><br />
                    <input class="form_button" type="submit" value="Submit">
                </fieldset>
            </form>
            </div>
</body>
</html>
