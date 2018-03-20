<?php
$mi_usuario='u722193362_root';
$mi_password='03032014';

$dir_destino = 'files/';
$imagen_subida = $dir_destino . basename($_FILES['img']['name']);

//Variables del metodo POST
$Id=$_POST['Id'];
$Descripcion=$_POST['Descripcion'];
$Unidad = strip_tags($_POST['Unidad']);

if(!is_writable($dir_destino)){
	echo "no tiene permisos";
}else{
	if(is_uploaded_file($_FILES['img']['tmp_name'])){
		echo "Archivo ". $_FILES['img']['name'] ." subido con éxtio.\n";
		echo "Mostrar contenido\n";
		echo $imagen_subida;
		if (move_uploaded_file($_FILES['img']['tmp_name'], $imagen_subida)) {
			$link = mysql_connect('localhost', $mi_usuario, $mi_password)
				or die('Uyy!!!: ' . mysql_error());
			mysql_select_db('datatables') or die('No pudo selecionar la BD');
			//Creamos nuestra consulta sql
			$query="insert into art(ID, Descripcion, Unidad,img) value ('$Id', '$Descripcion','$Unidad' '$imagen_subida')";
			
			//Ejecutamos la consutla
			mysql_query($query) or die('Error al procesar consulta: ' . mysql_error());

			echo "El archivo es fue cargado exitosamente.\n";

			echo "<p>$codigo</p>";
			echo "<p>$descripcion</p>";
			echo "<img src='files/". basename($imagen_subida) ."' />";
		} else {
			echo "Posible ataque de carga de archivos!\n";
		}
	}else{
		echo "Posible ataque del archivo subido: ";
		echo "nombre del archivo '". $_FILES['archivo_usuario']['tmp_name'] . "'.";
	}
}

?>