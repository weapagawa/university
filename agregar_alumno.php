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
<title>Agregar Alumno</title>
</head>

<body>
<?php include_once('barra.php') ?>
			<div>
            <form method="post" action="insertar_alumno.php"> 
                <fieldset class="forma_alumno">
          			<legend>Student Information</legend>
					Student ID: <input name="studentID" type="text"/><br />
                    First Name: <input name="first_name" type="text"/><br />
                    Last Name: <input name="last_name" type="text" /><br />
					Birth Date: <input name="b_date" type="text"/><br />
                    Street: <input name="street" type="text"/><br />
                    City: <input name="city" type="text"/><br />
                    Post Code: <input name="postcode" type="text"/><br />
                    <div class="field">
                        Sex:
                        <input name="sex" type="radio" value="M"  /><span class="form_special">Male</span>
                        <input name="sex" type="radio" value="F" /><span class="form_special">Female</span>
                    </div>
                    Phone Number: <input name="phone" type="text"/><br />
                    Email: <input name="email" type="text"/><br />
                    Category: <input name="category" type="text"/><br />
                    Nationality: <input name="nationality" type="text"/><br />
                    Special Needs: <input name="special_needs" type="text"/><br />
                    Comments: <input name="comments" type="text"/><br />
                    Status: <input name="status" type="text"/><br />
                    Major: <input name="major" type="text"/><br />
                    Minor: <input name="minor" type="text"/><br />
                    Next of kin's ID: <input name="nokID" type="text"/><br />
                    Next of kin's Name: <input name="nokName" type="text"/><br />
                    Next of kin's Address: <input name="nokAddr" type="text"/><br />
                    Next of kin's Phone: <input name="nokPhone" type="text"/><br />
                    Program: <select name="program">
		                    <!--Se revisa si hay por lo menos una fila de resultados-->
		                    <?php if (mysql_num_rows($programs) > 0) {?>
		                    <option selected="selected" value="null">Choose a program</option>
		                    <?php
		                        //Se itera a través de las filas de resultados y se crean opciones en el drop-down
		                            while($row = mysql_fetch_array($programs))
		                            {
		                                echo "<option value=".$row['id'].">".$row['name']."</option>";
		                            } 
		                        } else {
		                        echo "<option value=\"null\">There are no programs</option>";
		                     }                
		                    ?>        	
                    </select><br />
                    Advisor: <select name="advisor">
		                    <?php if (mysql_num_rows($staff) > 0) {?>
		                    <option selected="selected" value="null">Choose an advisor</option>
		                    <?php
		                    //Se itera a través de las filas de resultados y se crean opciones en el drop-down
		                        while($row = mysql_fetch_array($staff))
		                        {
		                            echo "<option value=".$row['id'].">".$row['name']."</option>";
		                        } 
		                     } else {
		                        echo "<option value=\"null\">There are no advisors</option>";
		                     }
		                    ?>    
                    </select><br />
                    <input class="form_button" type="submit" value="Submit">
                </fieldset>
            </form>
            </div>
</body>
</html>
