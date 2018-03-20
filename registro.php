
<?php
require_once('funciones.php');
require 'conexionp.php';

conectar($host,$user,$pw,$db);

// Datos recibidos desde el Formulario
// Datos recibidos desde el Formulario
echo '<link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">';
//variable($ejemplo) y nombre o id de el input de donde recibe los datos ('ejemplo')
$Id = strip_tags($_POST['id-hidden']);
$producto = strip_tags($_POST['producto']);
$tipo = strip_tags($_POST['tipo']);
$Descripcion = strip_tags($_POST['Descripcion']);
$talla = strip_tags($_POST['talla']);
$tela = strip_tags($_POST['tela']);
$Unidad = strip_tags($_POST['Unidad']);
$img = strip_tags($_POST['nombre']);
$corte = strip_tags($_POST['Corte']);
$boton_regresar = '<br><a role="button" href="entrar.php" class="btn btn-primary">Regresar</a></div>';

// selecciona la base de datos y consulta el ID o cable principal (codigo de barras)

$query = mysql_query('SELECT * FROM art  WHERE Id="'.mysql_real_escape_string($Id).'"');

//comprubeba no se encuntre registrado ya

if($existe = mysql_fetch_object($query))
{

//Si ya existe manda el siguiente mensaje

	echo "Este articulo ya esta registrado, Use otra clave o use la funcion Editar datos";


}else{

	//Si no existe lo inserta dentro de la base de datos (insert into base de datos) en los campos (campo1, campo2, campo 3) los valores (variable1, variable2, variable 3 etc..)

	$meter = @mysql_query('INSERT INTO art (Id,Producto,Tipo,Descripcion,Unidad,img,Talla,Tela,Corte,NC)
		values ("'.$Id.'","'.$producto.'","'.$tipo.'", "'.$Descripcion.'","'.$Unidad.'","files/'.$img.'.jpg", "'.$talla.'", "'.$tela.'" , "'.$corte.'", "'.$img.'")');
	if($meter)
	{

					echo"<div class='container-fluid'>El articulo ha sido registrado con exito";
					echo $boton_regresar ;

				}else{

								echo"<div class='container-fluid'>El articulo No ha sido registrado con exito";
								echo $boton_regresar ;
							}
}

if (!empty($_FILES['archivo']['tmp_name'])) {
//Extrae el nombre asignado
$nom = $_POST['nombre'];
$archivo=$_FILES['archivo']['name'];
$extension = explode(".",$archivo);
$ext = $extension[1];//AQUI LA EXTENSION
$valor = $nom.'.'.$ext;
// el archivo es guardado en la  carpeta
move_uploaded_file($_FILES['archivo']['tmp_name'], "files/".$valor);
// Mensaje de confirmación, no mostrado por entrar en conflico con el codigo del form
//echo "<script>alert('El archivo ha sido cargado correctamente')</script>";
}

?>
