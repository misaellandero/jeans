<?php
	if (isset($_POST['tag'])) {
		try {
			$conn = require_once 'connect.php';

			$sql = "SELECT * FROM  Estructurarollos_telas";
			$result = $conn->prepare($sql) or die ($sql);

			if (!$result->execute()) return false;

			if ($result->rowCount() > 0) {
				$json = array();
				while ($row = $result->fetch()) {
					$json[] = array(
						'id' => $row['id'],
						'codigo' => $row['codigo'],
						'id_art_telas' => $row['id_art_telas'],
						'metros' => $row['metros'],
						'fecha_creacion' => $row['fecha_creacion']
						
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