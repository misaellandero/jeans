<?php
header('Content-type: application/json');
	switch($_REQUEST['action']){
		case 'entradasKeyUp':
			require_once('../../funciones.php');
			require '../../conexionp.php';
			conectar($host,$user,$pw,$db);
			$sql="SELECT Producto,Tipo,Descripcion,Talla,Cantidad FROM art WHERE id = '" . mysql_real_escape_string($_POST['codigoBarras']) . "'";
			$rec=mysql_query($sql);
			if ($row=mysql_fetch_array($rec)) {
				//$row=mysql_fetch_array($rec);
				echo json_encode(
					array(
						'Producto' => $row['Producto'],
						'Tipo' => $row['Tipo'],
						'Descripcion' => $row['Descripcion'],
						'Talla' => $row['Talla'],
						'Cantidad' => $row['Cantidad'],
						'success' => true
					)
				);
			}else{
				echo json_encode(
					array(
						'success' => false
					)
				);
			}
			break;
		case 'verificaCodigo':
			require_once('../../funciones.php');
			require '../../conexionp.php';
			conectar($host,$user,$pw,$db);
			$sql='SELECT MAX(CAST(corte as SIGNED)) as corte FROM art WHERE Producto = "' . $_POST['producto'] . '" AND Tipo = "' . $_POST['modelo'] . '" AND Talla = "' . $_POST['talla'] . '" AND Tela = "' . $_POST['tela'] . '"';
			$rec=mysql_query($sql);
			if ($row=mysql_fetch_array($rec)) {
				$corte = intval($row['corte']) + 1;
				echo json_encode(
					array(
						'corte' => $corte,
						'select' => $sql,
						'success' => true
					)
				);
			}else{
				echo json_encode(
					array(
						'corte' => 1,
						'success' => true
					)
				);
			}
			break;
}
