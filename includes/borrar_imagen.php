<?php
		try {

			$conn = require_once '../conexionp.php';
			$id_img = ($_GET['id_img']);

			$consultar_img = "SELECT * FROM `modelo_de` WHERE `id` = '$id_img'";

			foreach ($conn->query($consultar_img) as $row) {
				$img = $row['id'];
				$borrar_img = "DELETE FROM `modelo_de` WHERE `id` = '$img' ";

				$result = $conn->prepare($borrar_img) or die ($borrar_img);
      if ($result->execute()) {
      	echo "1";
      }
				unlink('../files/fotos_modelos/'.$row['img']);
			}

		} catch (PDOException $e) {
		echo 'Error: '. $e->getMessage();
		}
?>
