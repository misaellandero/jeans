<?php

require_once('../funciones.php');
require '../conexionp.php';

conectar($host,$user,$pw,$db);

//Recibir

$descripsion = strip_tags($_POST['descripsion']);




	$meter = @mysql_query('INSERT INTO talla ( Descripcion) values ("'.mysql_real_escape_string($descripsion).'")');
	if($meter)
	{
	echo"<script type=\"text/javascript\">alert('El articulo ha sido registrado con exito'); window.location='../entrar.php';</script>";
	}else{
		echo"<script type=\"text/javascript\">alert('Hubo un error en el registro XDP'); window.location='../entrar.php';</script>";
	}


?>
