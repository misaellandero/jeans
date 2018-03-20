<?php
	if (isset($_POST['tag'])) {
		try {
			$conn = require_once 'connect.php';

			$sql = "SELECT * FROM art";
			$result = $conn->prepare($sql) or die ($sql);

			if (!$result->execute()) return false;

			if ($result->rowCount() > 0) {
				$json = array();
				while ($row = $result->fetch()) {
					$json[] = array(
						'Id' => $row['Id'],
						'Producto' => $row['Producto'],
						'Tipo' => $row['Tipo'],
						'Descripcion' => $row['Descripcion'],
						'NC' => $row['NC'],
						'Cantidad' => $row['Cantidad'],
						'Docenas' => $row['Docenas'],
						'Talla' => $row['Talla'],
						'Tela' => $row['Tela'],
						'img' => $row['img'],
						'Corte' => $row['Corte']
					);
				}

				$json['success'] = true;
				echo json_encode($json);
			}
		} catch (PDOException $e) {
			echo 'Error: '. $e->getMessage();
		}
	}

?>