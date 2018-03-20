<!doctype html>

<?php require_once('../Connections/conexion_usuarios.php'); ?>
<?php
header("Access-Control-Allow-Origin: *");
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
   
  $logoutGoTo = "usuario.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
} 
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?><?php
$colname_consulta_usuario = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_consulta_usuario = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
}
mysql_select_db($database_conexion_usuarios, $conexion_usuarios);
$query_consulta_usuario = sprintf("SELECT `user` FROM usuarios WHERE `user` = '%s'", $colname_consulta_usuario);
$consulta_usuario = mysql_query($query_consulta_usuario, $conexion_usuarios) or die(mysql_error());
$row_consulta_usuario = mysql_fetch_assoc($consulta_usuario);
$totalRows_consulta_usuario = mysql_num_rows($consulta_usuario);
?>
<!doctype html>
<html lang=''>
</header>

<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="Signin Template for Bootstrap_files/favicon.png">

   <title>Usuarios</title>

   <link href="../css/fontello.css" rel="stylesheet">
   <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/signin/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./Signin Template for Bootstrap_files/ie-emulation-modes-warning.js"></script>
</head>
<body>
<div class="container"> <form class="form-signin" id="form_ingreso" name="form_ingreso" method="POST" action="<?php echo $loginFormAction; ?>">
<div align="center"> <img src="../Signin Template for Bootstrap_files/logo.png"> <h1 class="form-signin-heading"><span class="icon-personas"> Usuarios</h1> <p>
        <h3>TynnosJeans</h3></div>

</form>

<div align="center"><h5>Bienvenido <span class="icon-emo-thumbsup"></span> &nbsp;  Usuario: <strong><?php echo $row_consulta_usuario['user']; ?><span class="icon-ok"></span>
&nbsp;<a href="<?php echo $logoutAction ?>"></strong>&nbsp;Salir&nbsp;<span class="icon-cancel-circled"></span></a>
<?php
mysql_free_result($consulta_usuario);
?></h5><!-- Standard button -->
<button type="button" class="btn btn-default"><span class="icon-list-alt"></span>Panel de Control </button>

<!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
<a href="http://tynnosjeans.com/PC/stock/entrar.php"><button type="button" class="btn btn-primary"><span class="icon-clipboard"></span> Inventario Producto Terminado</button></a>

<!-- Indicates a successful or positive action -->
<button type="button" class="btn btn-success"><span class="icon-buffer"></span> Inventario Telas</button>

<!-- Contextual button for informational alert messages -->
<button type="button" class="btn btn-info"><span class="icon-cubes"></span> inventario de insumos</button>

<!-- Indicates caution should be taken with this action -->
<button type="button" class="btn btn-warning"><span class="icon-proveedor"></span> Ventas en ruta</button>

<!-- Indicates a dangerous or potentially negative action -->
<button type="button" class="btn btn-danger"><span class="icon-chart-area">Finanzas</button>

<!-- Deemphasize a button by making it look like a link while maintaining button behavior -->
<div align="center"><p><h2><a href="http://tynnosjeans.com/"> TynnosJeans.com </a></h2> &reg 2015<p>
                     <p>Divisi&oacute;n de Ingenieria</p></div>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./Signin Template for Bootstrap_files/ie10-viewport-bug-workaround.js"></script>
</div>
</body>
<html>
