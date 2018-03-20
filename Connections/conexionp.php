<?php
require 'conexionp.php';


	class conexion{
		function recuperarDatos(){

			$con = mysql_connect($host, $user, $pw) or die("No se pudo conectar a la base de datos ");
			mysql_select_db($db, $con) or die ("No se encontro la base de datos. ");



		}
	}
?>
