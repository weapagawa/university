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
	
	$contrato = mysql_query("SELECT LeaseNumber, fname, lname FROM Student s, Lease l WHERE s.studentid = l.studentid ORDER BY " . 		
	"LeaseNumber") 	or die('ERROR LEASES: ' . mysql_error());
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
			<div>
            <form method="post" action="eliminar_contrato.php"> 
                <fieldset class="forma_alumno">
          			<legend>Lease Information</legend>
                    Lease Number: <select name="lNumber">
		                    <!--Se revisa si hay por lo menos una fila de resultados-->
		                    <?php if (mysql_num_rows($contrato) > 0) {?>
		                    <option selected="selected" value="null">Choose a lease</option>
		                    <?php
		                            while($row = mysql_fetch_array($contrato))
		                            {
		                                echo "<option value=".$row['LeaseNumber'].">".$row['LeaseNumber']. ' - '.$row['fname']
		                                . ' ' . $row['lname']."</option>";
		                            } 
		                        } else {
		                        echo "<option value=\"null\">There are no leases</option>";
		                     }                
		                    ?>        	
                    </select><br />
                    <input name="Enviar" type="submit" class="form_button" value="Delete">
                </fieldset>
            </form>
            </div>
</body>
</html>
