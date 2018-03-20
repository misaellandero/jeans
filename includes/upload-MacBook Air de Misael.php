    
	<form id="upload" name="upload" method="post" enctype="multipart/form-data" action="">
		<input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
		<input type="file" id="archivo" name="archivo">

		<p>
			<input type="submit" id="cargar" name="cargar" value="Cargar" class="btn btn-info">
		</p>
	</form>

	<?php
		if(isset($_POST['cargar'])){
			$nom = $_POST['nombre'];
			$ext = substr($_FILES['archivo']['name'], strrpos($_FILES['archivo']['name'], '.'));
			$valor = $nom.$ext;
			move_uploaded_file($_FILES['archivo']['tmp_name'], "files/".$valor);
			echo "<script>alert('El archivo ha sido cargado correctamente')</script>";
		}
	?>    	  
 </p>
