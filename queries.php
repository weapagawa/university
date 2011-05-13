<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Elija un Query!</title>
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
			<li><a href="reporte.php?queryType=4">Query A</a></li>
			<li><a href="reporte.php?queryType=5">Query B</a></li>
			<li><a href="reporte.php?queryType=6">Query C</a></li>
			<li><a href="reporte.php?queryType=7">Query D</a></li>
			<li><a href="reporte.php?queryType=8">Query E</a></li>
			<li><a href="reporte.php?queryType=9">Query F</a></li>
			<li><a href="reporte.php?queryType=10">Query G</a></li>
			<li><a href="reporte.php?queryType=11">Query H</a></li>
			<li><a href="reporte.php?queryType=12">Query I</a></li>
		
		</fieldset>
</body>
</html>
