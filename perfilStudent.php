<?php

	require_once('connectvars.php');
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
<title>Reporte Pagos</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>


<?php
	//Por medio de $_GET se obtiene el studentID y el nombre deseado.
	$id = $_GET['id'];


    $query = "SELECT  fname, lname 
    		  from Student
			  WHERE studentID = ".$id;

	$result = mysql_query($query);
	$row = mysql_fetch_array($result) or die(mysql_error());
	$fname = $row['fname'];
	$lname = $row['lname'];
?>
	<table border=1>
		<tr><th> Payment from <?php echo  $fname . ' ' . $lname ?></th></tr>

	</table>
	<p>


<?php

	$query = "SELECT paymentDue, paymentDate, paymentMethod FROM Invoice i, Lease l WHERE i.leaseNumber = l.LeaseNumber
				AND l.studentID = ".$id ." AND paymentDate IS NOT NULL";
	$result = mysql_query($query);


?>

	<table border=1>
		<tr>
			<th>Payment</th>
			<th>Payment Date</th>
			<th>Payment Method</th>
		</tr>
<?php
	while($row = mysql_fetch_array($result)) {
			echo "<tr>";
			// Se imprimen los resultados en forma de tabla. Nótese que se concatenan los campos de cada fila
			// con etiquetas HTML de tabla, para que el resultado en pantalla sea el de celdas con información.
			echo "<td>".$row['paymentDue']."</td>
					<td>".$row['paymentDate']."</td>
					<td>".$row['paymentMethod']."</td>";
			echo "</tr>";
	}


?>

	</table>
<?php

	$query = "SELECT sum(paymentDue) as pagos
				FROM Invoice
				WHERE  paymentDate is not NULL  and  leaseNumber = ".$id;
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$totalPagado=$row['pagos'];

?>
<P>
	<table border=1>
		<tr><th> Total Amount Paid        ------> $ <?php echo $totalPagado ?> </th></tr>
	</table>

<a href="reporte.php?queryType=7">Volver</a>
</body>
</html>
<?php mysql_close($conexion); ?>
