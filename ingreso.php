<?php require_once('Connections/conexion_usuarios.php'); ?>
<?php
mysql_select_db($database_conexion_usuarios, $conexion_usuarios);
$query_consulta_usuarios = "SELECT * FROM usuarios";
$consulta_usuarios = mysql_query($query_consulta_usuarios, $conexion_usuarios) or die(mysql_error());
$row_consulta_usuarios = mysql_fetch_assoc($consulta_usuarios);
$totalRows_consulta_usuarios = mysql_num_rows($consulta_usuarios);
?><?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['usuario'])) {
  $loginUsername=$_POST['usuario'];
  $password=$_POST['contrasena'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "entrar.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conexion_usuarios, $conexion_usuarios);
  
  $LoginRS__query=sprintf("SELECT user, password FROM usuarios WHERE user='%s' AND password='%s'",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysql_query($LoginRS__query, $conexion_usuarios) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="UTF=8">
<title>Sistema De Inventario</title>
    <link rel="stylesheet" type="text/css" href="styles/normalize.css">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="styles/jquery-ui-1.10.3.custom.css">
	<link rel="stylesheet" type="text/css" href="styles/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap-responsive.css">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap.css">

	<script src="scripts/jquery-1.9.1.js"></script>
	<script src="scripts/prefixfree.min.js"></script>
	<script src="scripts/jquery.dataTables.js"></script>
	<script src="scripts/jquery-ui-1.10.3.custom.js"></script>
	<script src="scripts/jquery-barcode.js"></script>
</head>

<body>
	<div id="mainWrapper">
	  <header>
	      <h1>Inicio de sesi&oacute;n-Tynnos Jeans</h1>
      </header>
       <nav>
            <ul class="nav nav-tabs">
               <li class="active"><a href="#">Ingrese credenciales</a></li>
              
           </ul>
           </nav>

<table>
<tr>
<th>
<form id="form_ingreso" name="form_ingreso" method="POST" action="<?php echo $loginFormAction; ?>">
<header id="titleContent">Usuario
  <label>
        <input name="usuario" type="text" id="usuario"  autocomplete="off"/>
  </label></header>
 <header id="titleContent">Contrase&ntilde;a 
   <label>
        <input name="contrasena" type="password" id="contrasena"  autocomplete="off" />
  </label>
  </header><header id="titleContent">
    <input class="btn btn-danger" type="submit" value=" Ingresar" />   </header> 
</form>
</tr>
</th>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($consulta_usuarios);
?>
