<?php
	
	require_once('connectvars.php');
	include_once('barra.php');
	/*mysql_connect es un metodo especial para realizar la conexion a la BD,
	los parametros pueden ser revisados en www.php.net*/
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
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte sencillo</title>
<link rel="stylesheet" type="text/css" href="style.css" /></head>

<body>


<?php

    
	//Por medio de $_GET se obtiene el studentID deseado.
	$id = $_GET['id'];


    $query = "SELECT  s.studentID, fname, lname, title, grade
						FROM Student s, Grades g, Course c
						WHERE  c.courseNumber = g.courseNumber and s.studentID = g.studentID and s.studentID =".$id;

	$result = mysql_query($query);
	
	
?>

	<table border=1>
		<tr><th> Student # <?php echo  $id?> Grades </th></tr>

	</table>
	<p>
    
    
<?php
   
    echo "<table border = 1>
        <tr>
            <th>Student ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Course</th>
            <th>Grade</th>";
            
  
        while($row = mysql_fetch_array($result)){
            echo "<tr>";
            echo "<td>".$row['studentID']."</td>
					<td>".$row['fname']."</td>
					<td>".$row['lname']."</td>
					<td>".$row['title']."</td>
					<td>".$row['grade']."</td>";
            echo "</tr>";
        }
        echo "</table>";
?>
    
<?php

    $query = "SELECT avg(g.grade) as Average FROM Grades g, Student s WHERE s.studentID = g.studentID and s.studentID =".$id;
    $result = mysql_query($query);
    
    echo "<table border = 1>
        <p>
        <th>Avarage</th>
        
        <tr>";
        while($row = mysql_fetch_array($result)){
        echo "<tr>";
        echo "<td>".$row['Average']."</td>";
        echo "</tr>";
        }
    echo "</table>";
    
?>

<a href="reporte.php?queryType=14">Volver</a>
</body>
</html>
<?php mysql_close($conexion); ?>
