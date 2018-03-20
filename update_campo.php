<?php
		try {
			$conn = require_once 'conexionp.php';

			$id = ($_GET['id']);
			$campo = ($_GET['campo']);
			$tabla = ($_GET['tabla']);
			$valor = ($_GET['valor']);

			$sql = "UPDATE `$tabla` SET `$campo`= '$valor' WHERE `id` = $id";

			 
			if ($conn->query($sql) == TRUE) {

				echo 1;

			}
			else
			{
				echo 0;
			}
		} catch (PDOException $e) {
		echo 'Error: '. $e->getMessage();
		}
?>
