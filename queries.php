<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Queries</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<!--Aquí estamos creando una forma con tres campos
	Con la propiedad action declaramos la página a la que se mandará la información
    Con la propiedad method se define el método que se utilizará para mandar la información-->
    <?php include_once("barra.php"); ?>
		<fieldset id="main">
			<legend>Informaci&oacute;n de University</legend>
		    <!--Se define el campo nombre-->
			<label for="queryType">Tipo de consulta:</label>

			<li><a href="reporte.php?queryType=1">Ver Contratos de Arrendamiento de Estudiantes</a></li>
			<li><a href="reporte.php?queryType=2">Ver Reporte de Inspecciones</a></li>
			<li><a href="reporte.php?queryType=3">Ver Reporte de Cursos</a></li>
			<li><a href="reporte.php?queryType=4">Gerentes</a></li>
			<li><a href="reporte.php?queryType=5">Estudiantes y sus contratos</a></li>
			<li><a href="reporte.php?queryType=6">Contratos que incluyen semestre de verano</a></li>
			<li><a href="reporte.php?queryType=7">Total de la renta pagada</a></li>
			<li><a href="reporte.php?queryType=8">Personas que deben invoice</a></li>
			<li><a href="reporte.php?queryType=9">Propiedad con condiciones no satisfactorias</a></li>
			<li><a href="reporte.php?queryType=10">Estudiantes en Residence Hall</a></li>
			<li><a href="reporte.php?queryType=11">Estudiantes en lista de Espera</a></li>
			<li><a href="reporte.php?queryType=12">Estudiantes por Categoria</a></li>
			<li><a href="reporte.php?queryType=13">Promedio de los alumnos</a></li>
			<li><a href="reporte.php?queryType=14">Historial Acad&eacute;mico</a></li>
		
		</fieldset>
</body>
</html>
