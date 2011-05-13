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
<title>Reporte sencillo</title>
<link rel="stylesheet" type="text/css" href="style.css" /></head>

<body>


<?php
	//Por medio de $_GET se obtiene el leaseNumber deseado.
	$id = $_GET['id'];


    $query = "SELECT  StartDate, EndDate, Duration
						FROM Lease
						WHERE LeaseNumber = ".$id;

	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$inicio=$row['StartDate'];
	$fin=$row['EndDate'];
?>
	<table border=1>
		<tr><th> Lease # <?php echo  $id ?> Period   <?php echo  $inicio.' to '.$fin ?> </th></tr>

	</table>
	<p>


<?php

	$query = "SELECT invoiceNo, semester, paymentDue, paymentDate, paymentDueDate, paymentMethod
				FROM Invoice
				WHERE leaseNumber = ".$id;
	$result = mysql_query($query);


?>

	<table border=1>
		<tr>
			<th>Invoice No.</th>
			<th>Semester</th>
			<th>Payment Due</th>
			<th>Payment Date</th>
			<th>Payment Due Date</th>
			<th>Payment Method</th>
		</tr>
<?php
	while($row = mysql_fetch_array($result)) {
			echo "<tr>";
			// Se imprimen los resultados en forma de tabla. Nótese que se concatenan los campos de cada fila
			// con etiquetas HTML de tabla, para que el resultado en pantalla sea el de celdas con información.
			echo "<td>".$row['invoiceNo']."</td>
					<td>".$row['semester']."</td>
					<td>".$row['paymentDue']."</td>
					<td>".$row['paymentDate']."</td>
					<td>".$row['paymentDueDate']."</td>
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

	$query = "SELECT sum(paymentDue) as pagospendientes
				FROM Invoice
				WHERE  paymentDate is  NULL  and  leaseNumber = ".$id;
	$totalAPagar= 0;

	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$totalAPagar= $row['pagospendientes'];
    if ($totalAPagar=='') {
	     $totalAPagar= 0.0;
	}

?>
<P>
	<table border=1>
		<tr><th> Total Amount Paid        ------> $ <?php echo $totalPagado ?> </th></tr>
		<tr><th> Total Amount to be paid  ------> $  <?php echo $totalAPagar ?> </th></tr>

	</table>



<a href="reporte.php?queryType=1">Volver</a>
</body>
</html>
<?php mysql_close($conexion); ?>
