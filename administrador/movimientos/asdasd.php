<!--//  Sistema de Inventarios Para la empresa Tynno Jeans 
// Tec. en Informática Francisco Misael Landero Ychante 
// Versión 3. ultima actualización 21/11/2014   --> 

<!--Codigo de registro del Form Principal--> 

<?php
require_once('../../funciones.php');
conectar('localhost', 'u722193362_root','03032014','u722193362_date');

// Datos recibidos desde el Formulario 

//variable($ejemplo) y nombre o id de el input de donde recibe los datos ('ejemplo') 
$Id = strip_tags($_POST['Id']);
$producto = strip_tags($_POST['producto']);
$tipo = strip_tags($_POST['tipo']);
$Descripcion = strip_tags($_POST['Descripcion']);
$talla = strip_tags($_POST['talla']);
$tela = strip_tags($_POST['tela']);
$Unidad = strip_tags($_POST['Unidad']);
$img = strip_tags($_POST['nombre']);
$Corte= strip_tags($_POST['Corte']);  


// selecciona la base de datos y consulta el ID o cable principal (codigo de barras)

$query = @mysql_query('SELECT * FROM art  WHERE Id="'.mysql_real_escape_string($Id).'"');

//comprubeba no se encuntre registrado ya 

if($existe = @mysql_fetch_object($query))
{

//Si ya existe manda el siguiente mensaje

	echo "<script type=\"text/javascript\">alert('Este articulo ya esta registrado, Use otra clave o use la funcion Editar datos'); window.location='entrar.php';</script>"; 
	
	
}else{
	
	//Si no existe lo inserta dentro de la base de datos (insert into base de datos) en los campos (campo1, campo2, campo 3) los valores (variable1, variable2, variable 3 etc..)
	
	$meter = @mysql_query('INSERT INTO art (Id,Producto,Tipo,Descripcion,Unidad,img,Talla,Tela,Corte) values ("'.$Id.'","'.$producto.'","'.$tipo.'", "'.$Descripcion.'","'.$Unidad.'","'.$tela.'", "'.$talla.'", "files/'.$img.'.jpg","'.$Corte.'")');
	if($meter)
	{
		// si el articulo se registro con exito manda el siguiente Mensaje
	echo"<script type=\"text/javascript\">alert('El articulo ha sido registrado con exito'); window.location='entrar.php';</script>"; 
	}else{
		// si el articulo no fue  registro con exito manda el siguiente Mensaje
		echo"<script type=\"text/javascript\">alert('Hubo un error en el registro'); window.location='entrar.php';</script>"; 
	}
}

?>
<!--Fin--> 

<!--Codigo de Carga de la imagen n el formulario--> 

<?php
		//detecta el boton cargar
		if(isset($_POST['cargar'])){
		//Extrae el nombre asignado	
			$nom = $_POST['nombre'];
			//Esto es un misterio ni idea como funciona pero funciona LOL Xp !!!
			//Supongo el archivo extradio y su nombre son remplzados por el nombre asignado 
			$ext = substr($_FILES['archivo']['name'], strrpos($_FILES['archivo']['name'], '.'));
			//se crea un nuevo archivo con el nombre creado y la extención del original
			$valor = $nom.$ext;
			// el archivo es guardado en la  carpeta 
			move_uploaded_file($_FILES['archivo']['tmp_name'], "files/".$valor);
			// Mensaje de confirmación, no mostrado por entrar en conflico con el codigo del form  
			echo "<script>alert('El archivo ha sido cargado correctamente')</script>";
		}
	?>
	<!--Fin--> 