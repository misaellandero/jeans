<?php
$host= "localhost";
$user = "u315449203_sis";
$pw = "CornComputerInc1*";
$db = "u315449203_sis";

	class conexion{
		function recuperarDatos(){

			$con = mysql_connect($host, $user, $pw) or die("No se pudo conectar a la base de datos ");
			mysql_select_db($db, $con) or die ("No se encontro la base de datos. ");

			/*$query = "SELECT * FROM producto";
			$resultado = mysql_query($query);

						while ($fila = mysql_fetch_array($resultado)) {
							echo " <table id="tp" cellspacing="1">
				<caption>Lista de Articulos</caption>
				<thead><tr><th>ID</th><th>Descripcion</th></thead>
				<tbody><tr>";
							echo "<td> $fila[Id]  </td> <td> $fila[Descripcion] </td> <br> ";
							echo " </tr></tbody></table> ";
						}*/

		}
	}


		return new PDO('mysql:host='.$host.';dbname='.$db,$user,$pw);


?>
