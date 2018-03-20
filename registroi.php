<?php		

		//detecta el boton cargar
		if(!empty($_FILES['archivo']['tmp_name'])){

			require_once('funciones.php');			
			conectar('localhost', 'u722193362_root','03032014','u722193362_date');

			$nombre = mysql_real_escape_string($_POST['nombrer']);
			//Extrae el nombre asignado	
			//$nom = $_POST['nombrer'];
			//Esto es un misterio ni idea como funciona pero funciona LOL Xp !!!
			//Supongo el archivo extradio y su nombre son remplzados por el nombre asignado 
			$ext = substr($_POST['name_image'], strrpos($_POST['name_image'], '.'));
			//se crea un nuevo archivo con el nombre creado y la extención del original
			$valor = $nombre.$ext;

			$sql="UPDATE art SET img = 'files/".$valor."' WHERE Id = '" . $_POST['id-art'] . "'";
			
			$rec=mysql_query($sql);
			if (!$rec) {
				echo"Error cambiando el nombre de la imagen";
				return;
			}

			if (file_exists($_POST['nombre-image-anterior'])) { unlink ($_POST['nombre-image-anterior']);}

			// el archivo es guardado en la  carpeta 
			if(move_uploaded_file($_FILES['archivo']['tmp_name'], "files/".$valor)) {
				echo"Nombre de archivo cambiado con exito"; 	
			}
			else{
				echo"Error cambiando el nombre de la imagen";
			}
			// Mensaje de confirmación, no mostrado por entrar en conflico con el codigo del form  
			
		}
	?>