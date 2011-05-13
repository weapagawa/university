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
<title>Proyecto University</title>	
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<?php
	//Por medio de $_GET se obtiene el tipo de query seleccionado en la forma anterior.
	$variable = $_GET['queryType'];
	
	switch ($variable) {
		case 1:
			//Si el query seleccionado fue el 1, simplemente se muestra el contenido de la tabla employee.
			$query = "SELECT LeaseNumber, StartDate, EndDate, Duration, Room.PlaceNumber, fname,lname, roomNumber
						FROM Lease,Student, Room
						WHERE Lease.StudentId = Student.StudentID and Room.placeNumber=Lease.placeNumber";
			$result = mysql_query($query) or die(mysql_error());
	
			echo "<table border=1>
					<tr>
						<th>LeaseNumber</th>
						<th>StartDate</th>
						<th>EndDate</th>
						<th>Duration</th>
						<th>Student Name</th>
						<th>PlaceNumber</th>
						<th>Room Number</th>
					</tr>";
			while($row = mysql_fetch_array($result)) {
					echo "<tr>";
					// Se imprimen los resultados en forma de tabla. Nótese que se concatenan los campos de cada fila
					// con etiquetas HTML de tabla, para que el resultado en pantalla sea el de celdas con información.
					echo "<td><a href=\"perfilLease.php?id=".$row['LeaseNumber']."\">".$row['LeaseNumber']."</td>
							<td>".$row['StartDate']."</td>
							<td>".$row['EndDate']."</td>
							<td>".$row['Duration']."</td>
							<td>".$row['fname'].' '.$row['lname']."</td>
							<td>".$row['PlaceNumber']."</td>
							<td>".$row['roomNumber']."</td>";
					echo "</tr>";
			}
			echo "</table>";
			break;
			
			case 2:
			//Si el query seleccionado fue el 1, simplemente se muestra el contenido de la tabla employee.
			$query = "SELECT Id, InspectionDate, SatisfactoryCondition, CONCAT( Fname, ' ', Lname ) AS Name, placeNumber
						FROM Inspection i, ResidenceStaff r WHERE i.residenceStaffNo = r.staffNo";
			$result = mysql_query($query) or die(mysql_error());
			
			echo "<h2 align=\"center\">Inspections</h2>";
			echo "<table border=1>
					<tr>
						<th>Id</th>
						<th>Inspection Date</th>
						<th>Satisfactory Condition</th>
						<th>Name</th>
						<th>Place Number</th>
					</tr>";
			while($row = mysql_fetch_array($result)) {
					echo "<tr>";
					// Se imprimen los resultados en forma de tabla. Nótese que se concatenan los campos de cada fila
					// con etiquetas HTML de tabla, para que el resultado en pantalla sea el de celdas con información.
					echo   "<td>".$row['Id']."</td>
							<td>".$row['InspectionDate']."</td>
							<td>".$row['SatisfactoryCondition']."</td>
							<td>".$row['Name']."</td>
							<td>".$row['placeNumber']."</td>";
					echo "</tr>";
			}
			echo "</table>";
			break;
			
			case 3:
			//Si el query seleccionado fue el 1, simplemente se muestra el contenido de la tabla employee.
			$query = "SELECT yearC, title, name, email FROM Course c, Instructor i WHERE c.instructorID = i.id ORDER BY yearC ASC";
			$result = mysql_query($query) or die(mysql_error());

			echo "<h2 align=\"center\">Courses</h2>";
			echo "<table border=1>
					<tr>
						<th>Year</th>
						<th>Title</th>
						<th>Course Instructor</th>
						<th>Instructor's email</th>
					</tr>";
			while($row = mysql_fetch_array($result)) {
					echo "<tr>";
					// Se imprimen los resultados en forma de tabla. Nótese que se concatenan los campos de cada fila
					// con etiquetas HTML de tabla, para que el resultado en pantalla sea el de celdas con información.
					echo   "<td>".$row['yearC']."</td>
							<td>".$row['title']."</td>
							<td>".$row['name']."</td>
							<td>".$row['email']."</td>";
					echo "</tr>";
			}
			echo "</table>";
			break;

			case 4:
			//Si el query seleccionado fue el 1, simplemente se muestra el contenido de la tabla employee.
			$query = "select phone, CONCAT(fname,' ', lname) as Manager from ResidenceHall r, ResidenceStaff s where r.residenceStaffNo =
			 s.staffNo and s.position = 'Hall Manager'";
			$result = mysql_query($query) or die(mysql_error());
			
			echo "<h2 align=\"center\">Managers</h2>";
			echo "<table border=1>
					<tr>
						<th>Manager</th>
						<th>Phone</th>
					</tr>";
			while($row = mysql_fetch_array($result)) {
					echo "<tr>";
					// Se imprimen los resultados en forma de tabla. Nótese que se concatenan los campos de cada fila
					// con etiquetas HTML de tabla, para que el resultado en pantalla sea el de celdas con información.
					echo   "<td>".$row['Manager']."</td>
							<td>".$row['phone']."</td>";
					echo "</tr>";
			}
			echo "</table>";
			break;
			
			case 5:
			//Si el query seleccionado fue el 1, simplemente se muestra el contenido de la tabla employee.
			$query = "SELECT fname, lname, s.studentID as bannerID, LeaseNumber, StartDate, EndDate, Duration, placeNumber FROM Student s,
					 Lease l WHERE s.studentID = l.StudentId";
			$result = mysql_query($query) or die(mysql_error());
			
			echo "<h2 align=\"center\">Students and Lease Agreements</h2>";
			echo "<table border=1>
					<tr>
						<th>Banner Id</th>
						<th>Name</th>
						<th>Lease Number</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Duration</th>
						<th>Place Number</th>
					</tr>";
			while($row = mysql_fetch_array($result)) {
					echo "<tr>";
					// Se imprimen los resultados en forma de tabla. Nótese que se concatenan los campos de cada fila
					// con etiquetas HTML de tabla, para que el resultado en pantalla sea el de celdas con información.
					echo   "<td>".$row['bannerID']."</td>
						   <td>".$row['fname']. ' ' . $row['lname']."</td>
						   <td>".$row['LeaseNumber']."</td>
						   <td>".$row['StartDate']."</td>
						   <td>".$row['EndDate']."</td>
						   <td>".$row['Duration']. ' months' . "</td>
							<td>".$row['placeNumber']."</td>";
					echo "</tr>";
			}
			echo "</table>";
			break;
			
			case 6:
					$query = "SELECT StartDate, EndDate, FName, LName FROM Lease l, Student s WHERE l.Duration = '12'
								AND l.studentid = s.studentID";
					$result = mysql_query($query) or die(mysql_error());
					
					echo "<h2 align=\"center\">Leases that include summer Semester</h2>";
					echo "<table border=1>
						<tr>
							<th>Name</th>
							<th>Start Date</th>
							<th>End Date</th>
						</tr>";
					while($row = mysql_fetch_array($result)) {
						echo "<tr>";
					// Se imprimen los resultados en forma de tabla. Nótese que se concatenan los campos de cada fila
					// con etiquetas HTML de tabla, para que el resultado en pantalla sea el de celdas con información.
					echo   "<td>".$row['FName'] . ' ' . $row['LName'] ."</td>
						   <td>".$row['StartDate']."</td>
						   <td>".$row['EndDate']."</td>";
					echo "</tr>";
			}
			echo "</table>";
			break;


			case 7:
				//Si el query seleccionado fue el 1, simplemente se muestra el contenido de la tabla employee.
				$query = "SELECT fname, lname, studentID FROM Student";

				$result = mysql_query($query) or die(mysql_error());
			
				echo "<h2 align=\"center\">Total Rent Paid</h2>";
				echo "<table border=1>
						<tr>


							<th>Banner Id</th>
							<th>Name</th>
						</tr>";
				while($row = mysql_fetch_array($result)) {
						echo "<tr>";
						// Se imprimen los resultados en forma de tabla. Nótese que se concatenan los campos de cada fila
						// con etiquetas HTML de tabla, para que el resultado en pantalla sea el de celdas con información.
						echo   "<td><a href=\"perfilStudent.php?id=".$row['studentID']."\">".$row['studentID']."</td>
							   <td>".$row['fname']. ' ' . $row['lname']."</td>";
						echo "</tr>";
				}
				echo "</table>";
				break;
			
			case 8:
					$query = "SELECT paymentDate, FName, LName FROM Invoice i, Lease l, Student s WHERE i.leaseNumber = l.LeaseNumber AND
					 l.studentID = s.studentID AND paymentDate IS NULL GROUP BY FName, LName";
					$result = mysql_query($query) or die(mysql_error());
					
					echo "<h2 align=\"center\">People that owe invoices</h2>";
					echo "<table border=1>
						<tr>
							<th>Name</th>
						</tr>";
					while($row = mysql_fetch_array($result)) {
						echo "<tr>";
					// Se imprimen los resultados en forma de tabla. Nótese que se concatenan los campos de cada fila
					// con etiquetas HTML de tabla, para que el resultado en pantalla sea el de celdas con información.
					echo   "<td>".$row['FName'] . ' ' . $row['LName'] ."</td>";
					echo "</tr>";
			}
					echo "</table>";
			break;
			
			case 9:
					$query = "SELECT InspectionDate, Comments, r.placeNumber, roomNumber FROM Inspection i, Room r WHERE
					 SatisfactoryCondition = 'No' AND r.placeNumber = i.placeNumber";
					$result = mysql_query($query) or die(mysql_error());
					
					echo "<h2 align=\"center\">Property with unsatisfactory conditions</h2>";
					echo "<table border=1>
						<tr>
							<th>Comments</th>
							<th>Place Number</th>
							<th>Room Number</th>
							<th>Inspection Date</th>
						</tr>";
					while($row = mysql_fetch_array($result)) {
						echo "<tr>";
					// Se imprimen los resultados en forma de tabla. Nótese que se concatenan los campos de cada fila
					// con etiquetas HTML de tabla, para que el resultado en pantalla sea el de celdas con información.
					echo   "<td>".$row['Comments'] ."</td>
							<td>" .$row['placeNumber'] . "</td>
							<td>" .$row['roomNumber'] . "</td>
							<td>" .$row['InspectionDate'] . "</td>";
					echo "</tr>";
			}
					echo "</table>";
					break;
			case 10:
					$query = "SELECT fname, lname, s.studentID, r.roomNumber, r.placeNumber, h.id as hallNumber FROM Lease l, Student s,
					 Room r, ResidenceHall h WHERE l.studentID = s.studentID AND l.placeNumber = r.placeNumber AND r.residenceID = h.id";
					$result = mysql_query($query) or die(mysql_error());
					
					echo "<h2 align=\"center\">Students by Residence Hall</h2>";
					echo "<table border=1>
						<tr>
							<th>Name</th>
							<th>Banner Number</th>
							<th>Room Number</th>
							<th>Place Number</th>
							<th>Residence Hall Number</th>
						</tr>";
					while($row = mysql_fetch_array($result)) {
						echo "<tr>";
					// Se imprimen los resultados en forma de tabla. Nótese que se concatenan los campos de cada fila
					// con etiquetas HTML de tabla, para que el resultado en pantalla sea el de celdas con información.
					echo   "<td>".$row['fname'] . ' ' . $row['lname'] ."</td>
							<td>" .$row['studentID'] . "</td>
							<td>" .$row['roomNumber'] . "</td>
							<td>" .$row['placeNumber'] . "</td>
							<td>" .$row['hallNumber'] . "</td>";
					echo "</tr>";
			}
					echo "</table>";
					break;

			case 11:

					$query = "SELECT fname, lname, email, category, major, minor FROM Student WHERE STATUS = 'waiting'";
					$result = mysql_query($query) or die(mysql_error());
					
					echo "<h2 align=\"center\">Students in waiting list</h2>";
					echo "<table border=1>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Category</th>
							<th>Major</th>
							<th>Minor</th>
						</tr>";
					while($row = mysql_fetch_array($result)) {
						echo "<tr>";
					// Se imprimen los resultados en forma de tabla. Nótese que se concatenan los campos de cada fila
					// con etiquetas HTML de tabla, para que el resultado en pantalla sea el de celdas con información.
					echo   "<td>".$row['fname'] . ' ' . $row['lname'] ."</td>
							<td>" .$row['email'] . "</td>
							<td>" .$row['category'] . "</td>
							<td>" .$row['major'] . "</td>
							<td>" .$row['minor'] . "</td>";
					echo "</tr>";
			}
					echo "</table>";
					break;

			case 12:
			
					$query = "select count(*) as grad from Student where category = 'graduate'";
					$result = mysql_query($query) or die(mysql_error());
					
					echo "<h2 align=\"center\">Students by category</h2>";
					echo "<table border=1>
						<tr>
							<th>Graduates</th>
						</tr>";
					while($row = mysql_fetch_array($result)) {
						echo "<tr>";
					// Se imprimen los resultados en forma de tabla. Nótese que se concatenan los campos de cada fila
					// con etiquetas HTML de tabla, para que el resultado en pantalla sea el de celdas con información.
					echo   "<td>".$row['grad'] ."</td>";
					echo "</tr>";
			}
					echo "</table>";
					
					$query = "select count(*) as under from Student where category = 'undergraduate'";
					$result = mysql_query($query) or die(mysql_error());
					
					echo "<br />";
					echo "<table border=1>
						<tr>
							<th>Undergraduates</th>
						</tr>";
					while($row = mysql_fetch_array($result)) {
						echo "<tr>";
					// Se imprimen los resultados en forma de tabla. Nótese que se concatenan los campos de cada fila
					// con etiquetas HTML de tabla, para que el resultado en pantalla sea el de celdas con información.
					echo   "<td>".$row['under'] ."</td>";
					echo "</tr>";
			}
					echo "</table>";
					break;

            case 13:
            
                    $query = "SELECT fname, lname, avg( grade ) as Average
                    FROM Grades g, Student s
                    WHERE g.studentID = s.studentID
                    GROUP BY g.studentID";
                    $result = mysql_query($query) or die(mysql_error());
                    
                    echo "<h2 align=\"center\">Student Grades</h2>";
                    echo "<table border=1>
                        <tr>
                            <th>Name</th>
                            <th>Grade Average</th>
                        </tr>";
                    while($row = mysql_fetch_array($result)) {
                        echo "<tr>";
                    echo "<td>".$row['fname'].' '.$row['lname']."</td>";
                    echo "<td>".$row['Average']."</td>";
                    echo "</tr>";
                    }
                        
                    echo "</table>";
                    break;
                    
            case 14:
			//Si el query seleccionado fue el 1, simplemente se muestra el contenido de la tabla employee.
			$query = "SELECT studentID, fname, lname
            FROM Student";
			$result = mysql_query($query) or die(mysql_error());
            
             echo "<h2 align=\"center\">Relaci&oacute;n de estudiantes inscritos que ya han cursado materias. Para ver sus materias cursadas y promedio de &eacute;stas, haz click sobre su matricula</h2>";
			echo "<table border=1>
					<tr>
						<th>Student ID</th>
						<th>First Name</th>
						<th>Last Name</th>
					</tr>";
			while($row = mysql_fetch_array($result)) {
					echo "<tr>";
					// Se imprimen los resultados en forma de tabla. Nótese que se concatenan los campos de cada fila
					// con etiquetas HTML de tabla, para que el resultado en pantalla sea el de celdas con información.
					echo "<td><a href=\"perfilStudentGrades.php?id=".$row['studentID']."\">".$row['studentID']."</td>
							<td>".$row['fname']."</td>
							<td>".$row['lname']."</td>";
					echo "</tr>";
			}
			echo "</table>";
			break;
					

		default: 
			
	}
?>
<a href="queries.php">Volver</a>
</body>
</html>
<?php mysql_close($conexion); ?>

