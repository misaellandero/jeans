<?php
function conectar ($servidor, $user, $pass, $name)

{
	$con =@mysql_connect($servidor, $user, $pass);
	@mysql_select_db($name, $con );
}
$conexion=mysql_connect("localhost","u722193362_root","03032014");

if(!$conexion)
{
	die("No se pudo realizar la conexión a la Db" . mysql_error());

	mysql_select_db("inventario",&conexion);
}
?>