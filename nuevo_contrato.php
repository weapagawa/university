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

	$student = mysql_query("SELECT studentID, fname, lname FROM Student") or die ('ERROR STUDENTS: ' . mysql_error());	
	$place = mysql_query("SELECT placeNumber from Room order by placeNumber") or die ('ERROR STUDENTS: ' . mysql_error());	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet">
<title>Agregar Contrato</title>
</head>

<body>
<?php include_once('barra.php') ?>
			<div>
            <form method="post" action="insertar_contrato.php"> 
                <fieldset class="forma_alumno">
          			<legend>New Lease</legend>
					Lease Number: <input name="leaseNum" type="text"/><br />
                    Start Date: <input name="sDate" type="text"/><br />
                    End Date: <input name="eDate" type="text"/><br />
                    Duration (months): <input name="duration" type="text"/><br />
                    Student making the lease: <select name="student">
		                    <!--Se revisa si hay por lo menos una fila de resultados-->
		                    <?php if (mysql_num_rows($student) > 0) {?>
		                    <option selected="selected" value="null">Choose a student</option>
		                    <?php
		                            while($row = mysql_fetch_array($student))
		                            {
		                                echo "<option value=".$row['studentID'].">".$row['fname']. ' ' . $row['lname']."</option>";
		                            } 
		                        } else {
		                        echo "<option value=\"null\">There are no programs</option>";
		                     }                
		                    ?>        	
                    </select><br />
                    Place Number: <select name="room">
		                    <!--Se revisa si hay por lo menos una fila de resultados-->
		                    <?php if (mysql_num_rows($place) > 0) {?>
		                    <option selected="selected" value="null">Choose a room</option>
		                    <?php
		                            while($row = mysql_fetch_array($place))
		                            {
		                                echo "<option value=".$row['placeNumber'].">".$row['placeNumber']."</option>";
		                            } 
		                        } else {
		                        echo "<option value=\"null\">There are no rooms</option>";
		                     }                
		                    ?>        	
                    </select><br />                    
                    <input class="form_button" type="submit" value="Submit">
                </fieldset>
            </form>
            </div>
</body>
</html>
