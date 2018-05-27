<?php
	try {
		$conn = require_once 'conexionp.php';
		$ds          = DIRECTORY_SEPARATOR;  //1


		$storeFolder = 'files/fotos_modelos';   //2

		if (!empty($_FILES)) {


				$id_modelo = ($_POST['id_modelo']);
				$titulo_img = ($_POST['titulo_img']);
				$texto_img = ($_POST['texto_img']);

		if ($titulo_img == '') {
			$titulo_img = "foto_modelo";
		}
		$nombre =($_FILES['file']['name']);
		$nuevonombre = ($id_modelo.$titulo_img.$nombre);

		$ext =($_FILES['file']['type']);

    $tempFile = $_FILES['file']['tmp_name'];          //3
																											//comprimir imagen
		$original = imagecreatefromjpeg($tempFile);
		//Ancho y alto máximo de la imagen
		$max_ancho = 1800; $max_alto = 1800;

		//Medir la imagen
		list($ancho,$alto)=getimagesize($tempFile);

		//Ratio
		$x_ratio = $max_ancho / $ancho;
		$y_ratio = $max_alto / $alto;

		//Proporciones
		if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
		    $ancho_final = $ancho;
		    $alto_final = $alto;
		}
		else if(($x_ratio * $alto) < $max_alto){
		    $alto_final = ceil($x_ratio * $alto);
		    $ancho_final = $max_ancho;
		}
		else {
		    $ancho_final = ceil($y_ratio * $ancho);
		    $alto_final = $max_alto;
		}
		//Crear un lienzo
		$lienzo=imagecreatetruecolor($ancho_final,$alto_final);

		//Copiar original en lienzo
		imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);

		//Destruir la original
		imagedestroy($original);


		//Proporciones
		if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
		    $ancho_final = $ancho;
		    $alto_final = $alto;
		}
		else if(($x_ratio * $alto) < $max_alto){
		    $alto_final = ceil($x_ratio * $alto);
		    $ancho_final = $max_ancho;
		}
		else {
		    $ancho_final = ceil($y_ratio * $ancho);
		    $alto_final = $max_alto;
		}

    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4


		$sqlimg =  "SELECT * FROM `modelo_de`  WHERE `titulo` = '$titulo_img' and `id_modelo` = $id_modelo ";
		$result = $conn->prepare($sqlimg) or die ($sqlimg);

		if (!$result->execute()) return false;

		if ($result->rowCount() > 0) {

			$repetidos = $result->rowCount() + 1;

			$nuevonombre = ($id_modelo.$repetidos.$titulo_img.$nombre);


		}
			$sql = "INSERT INTO `modelo_de` (`titulo`, `codigo`,`texto`,`img`,`id_modelo`) VALUES ('$titulo_img','$texto_img','$nuevonombre','$id_modelo')";

	    $conn->query($sql);

			$targetFile =  $targetPath. $nuevonombre;  //5

			//Crear la imagen y guardar en directorio upload/
			imagejpeg($lienzo,$targetFile);

			$ruta_remota = "jeans/files/fotos_modelos/$nuevonombre";


			// set up basic connection
			$conn_id = ftp_connect("ftp.ceyeme.mx");
			$ftp_user_name= "u315449203";
			$ftp_user_pass= "UTkFYCS7xtPK";
			// login with username and password
			$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

			// upload a file
			if (ftp_put($conn_id, $ruta_remota, $targetFile, FTP_ASCII)) {
					echo "successfully uploaded $ruta_local\n";
					exit;
			} else {
					echo "There was a problem while uploading $ruta_local\n";
					exit;
					}
			// close the connection
			ftp_close($conn_id);




}

}

catch (PDOException $e) {
                echo 'Error: '. $e->getMessage();
                }

?>
