<?php

//var_dump($_POST);die();

require_once('../../funciones.php');
require '../../conexionp.php';

conectar($host,$user,$pw,$db);

session_start();
$usuario = $_SESSION['MM_Username'];

$Id = $_POST['Id'];
// $Producto = $_POST['Producto'];
// $tipo = $_POST['tipo'];
// $Descripcion = $_POST['Descripcion'];
// $talla = $_POST['talla'];
$Cantidad= $_POST['cantidad'];
$tipo = $_POST["tipo-movimiento"];

for($i = 0; $i<count($Id); $i++) {

	$sql = "Insert Into hist_mov_ent_sal (codigo_id,tipo_mov,cantidad,usuario,detalles)
		values('" . $Id[$i] . "','".$tipo."', " .$Cantidad[$i] . ",'".$usuario."',"");";
	$retval = mysql_query( $sql);
	if (!$retval){
		echo mysql_error();
	}

	$sql = "Update art SET cantidad = (cantidad ". ($tipo === "entrada" ? "+" : "-")." ". $Cantidad[$i] . ") WHERE id = '" . $Id[$i] . "'" ;
	$retval = mysql_query( $sql);
	if (!$retval){
		echo mysql_error();
	}
}

echo"<script type=\"text/javascript\">alert('El proceso se realizo con exito'); window.location='../../entrar.php';</script>";

?>
