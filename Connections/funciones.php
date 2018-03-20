<?php
function conectar($servidor, $user, $pass, $name)
{
	$con = @mysql_connect($servidor, $user, $pass);
	@mysql_select_db($name, $con);	
}

function retConectar($servidor, $user, $pass)
{
	$con = @mysql_connect($servidor, $user, $pass);

	return $con;

}

?>