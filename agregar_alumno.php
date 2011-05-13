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
            <form method="post" action="insertar_alumno.php"> 
                <fieldset>
          			<legend>Student Information</legend>
                    <label for="studentID">Student ID:</label>
                    <input name="studentID" type="text"/>
                    <label for="first_name">First Name:</label>
                    <input name="first_name" type="text"/>
                    <label for="last_name">Last Name:</label>
                    <input name="last_name" type="text" />
                    <label for="b_date">Birth Date:</label>
                    <input id="b_date" name="b_date" type="text"/>
                    <label for="street">Street:</label>
                    <input name="street" type="text"/>
                    <label for="city">City:</label>
                    <input name="city" type="text"/>
                    <label for="postcode">Post Code:</label>
                    <input name="postcode" type="text"/>                                        
                    <div class="field">
                        <label for="sex">Sex:</label>
                        <input name="sex" type="radio" value="M"  /><span class="form_special">Male</span>
                        <input name="sex" type="radio" value="F" /><span class="form_special">Female</span>
                    </div>
                    <label for="phone">Phone Number:</label>
                    <input name="phone" type="text"/>
                    <label for="email">Email:</label>
                    <input name="email" type="text"/>
                    <label for="category">Category:</label>
                    <input name="category" type="text"/>                                        
                    <label for="nationality">Nationality:</label>
                    <input name="nationality" type="text"/>                    
                    <label for="special_needs">Special Needs:</label>
                    <input name="special_needs" type="text"/>                    
                    <label for="comments">Comments:</label>
                    <input name="comments" type="text"/>
                    <label for="status">Status:</label>
                    <input name="status" type="text"/>
                    <label for="major">Major:</label>
                    <input name="major" type="text"/>
                    <label for="minor">Minor:</label>
                    <input name="minor" type="text"/>                    
                    <label for="nokID">Next of kin's ID:</label>
                    <input name="nokID" type="text"/>                    
                    <label for="nokName">Next of kin's Name:</label>
                    <input name="nokName" type="text"/>
                    <label for="nokAddr">Next of kin's Address:</label>
                    <input name="nokAddr" type="text"/>
                    <label for="nokPhone">Next of kin's Phone:</label>
                    <input name="nokPhone" type="text"/>
                    <label for="program">Program:</label>
                    <select name="program">
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
                    </select>
                    <label for="advisor">Advisor:</label>
                    <select name="advisor">
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
                    </select>
                    <input class="form_button" type="submit" value="Submit">
                </fieldset>
            </form>

</body>
</html>
