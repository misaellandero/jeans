<?php
		header('Content-Type: application/json');
		try {

			$conn = require_once '../conexionp.php';

			$id_modelo = ($_GET['id_modelo']);

			$sql = "SELECT * FROM  `modelo_de` WHERE `id_modelo` = '$id_modelo'";
			$result = $conn->prepare($sql) or die ($sql);


			if (!$result->execute()) return false;

			if ($result->rowCount() > 0) {
				$json = array();
				while ($row = $result->fetch()) {

					$json[] = array(
            'id' => $row['id'],
            'titulo' => $row['titulo'],
						'img' => $row['img'],
						'texto'  => $row['texto']
					);

				}

				$json['success'] = true;
				echo json_encode($json);

			}else {
				echo 1;
			}
		} catch (PDOException $e) {
			echo 'Error: '. $e->getMessage();
		}

?>
