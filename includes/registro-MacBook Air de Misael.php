<html>

<?php

require_once('funciones.php');
conectar('localhost', 'u722193362_date','03032014','u722193362_root');

//Recibir
$ID = strip_tags($_POST['ID']);
$Descripsion = strip_tags($_POST['Descripsion']);
$Unidad = strip_tags($_POST['Unidad']);
$Cantidad = strip_tags($_POST['Cantidad']);


$query = @mysql_query('SELECT * FROM articulos  WHERE ID="'.mysql_real_escape_string($ID).'"');
if($existe = @mysql_fetch_object($query))
{
	echo 'EL ARTICULO '.$ID.' ya Esta registrado use otra clave o la función editar para modificar datos.';	
}else{
	$meter = @mysql_query('INSERT INTO articulos (ID, Descripsion, Unidad,Cantidad,img) values ("'.$ID.'", "'.mysql_real_escape_string($Descripsion).'", "'.mysql_real_escape_string($Unidad).'", "'.$Cantidad.'", "files/'.mysql_real_escape_string($ID).'.jpg")');
	if($meter)
	{
		echo 'Articlo Registrado con Exito';
	}else{
		echo 'Hubo un error en el registro.';	
	}
}

?>
