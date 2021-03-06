<?php require_once('Connections/conexion_usuarios.php'); ?>
<?php
header("Access-Control-Allow-Origin: *");
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

$verificado = false;
$modulos = $_SESSION['MM_Modulos'];

foreach ($modulos as $modulo)
  {
    if ($modulo === 'stock')
      {
        $verificado = true;
      }
  }
    if ($verificado === false) {

      header ('Location:index.php');
}





function validar_pestana($modulo, $verificar_pestana)

{

  $pestanas= $_SESSION['MM_pestanas'];


   foreach ($pestanas as $pestana)
   {
      if (key($pestana) == $modulo && current($pestana) == $verificar_pestana)

      {
        return true;
      }
   }
   return false;
}

?>
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

  $logoutGoTo = " index.php";
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

$MM_restrictGoTo = "index.php";
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
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->



<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="description" content="Inventario Producto terminado">



    <title>Inventario Producto terminado </title>

	<link rel="stylesheet" type="text/css" href="styles/style.css">

  <link rel="stylesheet" href="styles/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="scripts/DataTables/datatables.css"/>
  <script src="scripts/jquery.js"></script>


  <script type="text/javascript" src="scripts/DataTables/datatables.js"></script>



  <script src="scripts/functions.js"></script>


  <script src="scripts/jquery-barcode.js"></script>
  <script src="scripts/jquery-impromptu.js"></script>

  <script src="styles/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

  <!--iOS -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="img/favicon.png">
<link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-ipad-retina.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-iphone-retina.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-ipad.png">
<link rel="apple-touch-icon" sizes="57x57" href="img/apple-touch-icon-iphone.png">

<script src="scripts/dropzone.js"></script>
  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->



</head>
<body class="demo">
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->

  <!-- Demo content -->
  <div id="demo-content">

    <div id="loader-wrapper">
      <div id="loader"></div>

      <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>

    </div>

    <div id="content">


<header>

<div id="Userdiv">




    <!-- Script de la fecha actual -->
<?php
mysql_free_result($consulta_usuario);
?><div style="float:right;">

<div id="reloj" style="font-size:20px;"></div>
</div></h5></header>
</script>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <?php
                $sql="SELECT `img` FROM `usuarios` WHERE `id_empleado`=  {$_SESSION['MM_UserId']}";
                $rec_i=mysql_query($sql);
                     while ($row=mysql_fetch_array($rec_i)) {
                                                               echo "<img class='rounded-circle' width='30' height='30' src='../files/".$row["img"]."'  width='4%' class='img-circle'>";
                                                            }
              ?>
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <a href="#"><?php echo $row_consulta_usuario['user']; ?></a>
    <ul id="menu"  class="nav navbar-nav mr-auto">
      <li class="nav-item"><a class="nav-link" href="#" <?php echo  (validar_pestana('stock', 'registrar')) ? '' : 'style="display:none"'; ?>><span class="icon-plus-squared-alt"></span> Registrar</a></li>
      <li class="nav-item active"><a class="nav-link" href="#" <?php echo  (validar_pestana('stock', 'buscar')) ? '' : 'style="display:none"'; ?>><span class="icon-search"></span> Buscar</a></li>
      <li class="nav-item"><a class="nav-link" href="#" <?php echo  (validar_pestana('stock', 'datos')) ? '' : 'style="display:none"'; ?>><span class=" icon-pencil-squared"></span> Datos</a></li>
      <li class="nav-item"><a class="nav-link" href="#" <?php echo  (validar_pestana('stock', 'entradas')) ? '' : 'style="display:none"'; ?>><span class="icon-download"></span> Entradas</a></li>
      <li class="nav-item"><a class="nav-link" href="#" <?php echo  (validar_pestana('stock', 'salidas')) ? '' : 'style="display:none"'; ?>><span class="icon-upload"></span> Salidas</a></li>
      <li class="nav-item"><a class="nav-link" href="#" <?php echo  (validar_pestana('stock', 'movimientos')) ? '' : 'style="display:none"'; ?>><span class="icon-spin3"> </span> Movimientos</a></li>

    </ul>
    <form class="form-inline my-2 my-lg-0">
       <a href="<?php echo $logoutAction ?>"><button class="btn btn-outline-danger my-2 my-sm-0">
         Salir</button>  </a>
    </form>
  </div>
</nav>


<header id="titleContent">Buscar Articulo</header>
<section>
      <article id="aRegister">
        <div class="row-fluid">
          <div class=" ">
          <?php include('form.php'); ?>
          <script type="text/javascript">

            var formRegistro = $("#registro-producto");

            var crearId = function(){
              formRegistro.find("#Id").val(formRegistro.find("#id-sugerido").val());
              formRegistro.find("#Id").trigger("keyup");
              formRegistro.find("#id-hidden").val(formRegistro.find("#Id").val());
            }


            var crearCorte = function(claveSugerida){
              $.ajax({
                  url: 'administrador/movimientos/registroAjax.php',
                  type: 'post',
                  data: { 'producto': formRegistro.find("#producto option:selected").html(), 'modelo' : formRegistro.find("#tipo option:selected").html(), 'talla' : formRegistro.find("#talla option:selected").html(), 'tela' : formRegistro.find("#tela option:selected").html() , 'action' : 'verificaCodigo'},
                  dataType: 'json',
                  success: function (data) {
                      if (data.success) {

                          var cod = parseInt(data.corte);

                          if (claveSugerida.length == 10 && cod <= 9){cod = "0" + cod;}

                          $("#Corte").val(cod);
                          claveSugerida += cod;

                          formRegistro.find("#id-sugerido").val(claveSugerida);
                          crearId();

                      }
                  },
                  error: function (jqXHR, textStatus, errorThrown){
                      alert(JSON.stringify(jqXHR));
                      //alert(textStatus);
                  }
              });
            }

            var fnClaveSugerida = function (){
                var claveSugerida = "";
                formRegistro.find("select").not("#unidad-registro").each(function(i){
                  var cod = $(this).find("option:selected").attr('val');
                  if ($.type(cod) !== "undefined"){
                    if (cod.length <= 1){cod = "0" + cod;}

                    // if (cod.length <= 1 && $(this).attr("id") === "tipo"){cod = "00" + cod;}
                    // if (cod.length == 2 && $(this).attr("id") === "tipo"){cod = "0" + cod;}

                    // if (cod.length <= 1 && $(this).attr("id") === "Descripcion"){cod = "00" + cod;}
                    // if (cod.length == 2 && $(this).attr("id") === "Descripcion"){cod = "0" + cod;}

                    claveSugerida += cod;
                  }
                });

                crearCorte(claveSugerida);

            }

            fnClaveSugerida();

            formRegistro.find("select").not("#unidad-registro").change(function(){
              fnClaveSugerida();
            });

          </script>
          </div>
          <div class="col-md-6 col-sm-12">

              <div class="alert"></div>


        </div>
      </article>
      <article id="aSearch" >
          <div class="row">
            <div class="col-md-12">
              <table class="table table-hover" id="tSearch" width="100%" >
              <caption>Lista de Articulos</caption>
              <thead>
                    <tr>
                      <th>ID</th>
                      <th>Producto</th>
                                  <th>Tipo</th>
                                    <th>Descripcion</th>
                                    <th>Corte</th>
                                    <th>Piezas</th>
                                    <th>Docenas</th>
                                       <th> Talla </th>
                                       <th> Tela </th>
                                       <th> imagen </th>
                                       <th>NC</th>
                   </tr>
                  </thead>
              <tbody>
              </tbody>
              </table>
            </div>
          </div>
  <h3 id="suma-busqueda-stock"></h3>
    <div>

    <input type="button"  value="Imprimir Inventario" class="btn btn-success" onclick='window.print();'>
    <input type="button"  value="Ver" class="btn btn-success" id="ver-codigo">
    <input type="button"   value="Ver Codigo" class="btn btn-success" id="ver-codigo-solo"></div><br>

        <!-- Modal -->
    <div class="modal fade" id="ventana_datos_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Informacion articulo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row"  id="contenido-imprimir-codigo">
                <div class="col-md-6">

                    <!-- Ultima actualizacion:<i></i> -->

                  <div id="datos-codigo"> </div><?php //include('uploadi.php'); ?>
                </div>
                <div class="col-md-6" >
                <img id="img_destino_articulo_imprimir" class="img-fluid" src="#" alt="Tu imagen">
                  <div class="contentBarcode">
                    <div class="barCode">
                      <header style='width:115;'><h4>Codigo</h4></header>
                        <div style='width:115;height:70;'>
                          <?php include('CodigoB2.php'); ?>

                          <div id="valor-codigo" style="clear:both;margin-top:0px; width: 100%; background-color: #FFFFFF; color: #000000; text-align: center; font-size: 10px; margin-top: 5px;"></div>
                        </div>

                    </div>
                    <!-- <a href="#" class="btn btn-primary">Guardar</a> -->
                    <!-- <div class="alert"></div> -->
                  </div>
                </div>
                <div class="bg-light rounded col-md-12">
                  <br>
                  <br>
                  <h4>Añadir magenes Extra</h4>



                        <label class="control-label col-md-12">Titulo<span class="required"></span>
                        </label>
                        <div class="col-md-12 ">
                         <textarea id="tit_notas" class="form-control" rows="2" cols="80"></textarea>
                        </div>
                        <label class="control-label col-md-12 ">Detalles<span class="required"></span>
                        </label>
                        <div class="row">
                          <div class="col-md-6">
                           <textarea id="text_notas" class="form-control" rows="8" cols="80"></textarea>
                         </div>

                      <form id="upload_fotos" class="col-md-6 dropzone" action="form_upload.php" style="border: 1px solid #e5e5e5; height: 300px;">
                                  <input type="number" name="id_modelo"  id="id_modelo" hidden="true">
                                  <input type="text"  name="titulo_img" id="titulo_img" hidden="true">
                                  <input type="text"  name="texto_img" id="texto_img" hidden="true">
                      </form>

                      <h4>Imagenes Extra</h4>
                      <div class="form-control">
                        <button id="cargar_imagenes" name="cargar" class="btn btn-outline-info">Mostrar imagenes</button>
                        <div id="contenedor_imagenes" class="col-md-12">

                        </div>
                      </div>

                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
              </form>
          </div>
        </div>
      </div>
    </div>



  </article>
    <article id="aDates">

    <h3>A&ntilde;adir Datos</h3>
    <div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 col-sm-12">
           <h3>Datos Registrados</h3><caption><h4>Lista de Lineas de Productos</h4></caption>
         <table id="tp" class="table table-striped  table-hover" cellspacing="0" width="100%" >
           <thead><tr><th>ID</th><th>Descripcion</th></tr></thead>
           <tbody>
              <?php
               $query = "SELECT * FROM producto";
               $resultado = mysql_query($query);

               while ($fila = mysql_fetch_array($resultado)) {
                 echo " <tr>";
                 echo "<td> $fila[Id]  </td> <td> $fila[Descripcion] </td>";
                 echo " </tr>";
               }?></tbody></table>
                    <h5>Registrar Nueva Linea de Producto</h5><?php include('administrador/formp.php'); ?>

           </div>

           <div class="col-md-6 col-sm-12">
  <h3>Datos Registrados</h3><caption><h4>Lista de Tipos de Producto</h4></caption>
 <table  class="table table-striped  table-hover" cellspacing="0" width="100%" >

   <thead><tr><th>ID</th><th>Descripcion</th></tr></thead>
   <tbody>
      <?php
      $query = "SELECT * FROM tipo";
      $resultado = mysql_query($query);

      while ($fila = mysql_fetch_array($resultado)) {
        echo " <tr>";
        echo "<td> $fila[Id]  </td> <td> $fila[Descripcion] </td>";
        echo " </tr>";

  } ?></tbody></table><div class="col-md-6 col-sm-12"><h5> Registrar Nuevo Tipo de Producto</h5><?php include('administrador/formt.php'); ?>
   </div></div>
        </div>
    </div>



        <div>


          <div class="col-md-6 col-sm-12">  <h3>Datos Registrados</h3><caption><h4>Lista de Modelo</h4></caption>
<table  id="tp" class="table table-striped  table-hover" cellspacing="0" width="100%">

  <thead><tr><th>ID</th><th>Descripcion</th></tr></thead>
  <tbody>
     <?php
     $query = "SELECT * FROM modelo";
      $resultado = mysql_query($query);

      while ($fila = mysql_fetch_array($resultado)) {
        echo " <tr>";
        echo "<td> $fila[Id]  </td> <td> $fila[descripsion] </td>";
        echo " </tr>";

  }
           ?></tbody></table>
         <div class="col-md-6 col-sm-12"> <h5> Registrar Nuevo Modelo</h5><?php include('administrador/formm.php'); ?></div>
  </div>
          <div class="col-md-6 col-sm-12">  <h3>Datos Registrados</h3><caption><h4>Lista de Talla</h4></caption>
<table  id="tp" class="table table-striped  table-hover" cellspacing="0" width="100%"  >

  <thead><tr><th>ID</th><th>Descripcion</th></tr></thead>
  <tbody>
     <?php 	$query = "SELECT * FROM talla";
 			$resultado = mysql_query($query);

 			while ($fila = mysql_fetch_array($resultado)) {
 				echo " <tr>";
 				echo "<td> $fila[Id]  </td> <td> $fila[Descripcion] </td>";
 				echo " </tr>";

 	}?></tbody></table><div class="col-md-6 col-sm-12"> <h5>Registrar Nueva Talla</h5><?php include('administrador/formta.php'); ?></div>
          <div class="col-md-6 col-sm-12"> <h3>Datos Registrados</h3><caption><h4>Lista de Tela</h4></caption>
<table id="tp" class="table table-striped  table-hover" cellspacing="0" width="100%"  >

  <thead><tr><th>ID</th><th>Descripcion</th></tr></thead>
  <tbody>
     <?php

     $query = "SELECT * FROM tela";
     $resultado = mysql_query($query);

     while ($fila = mysql_fetch_array($resultado)) {
       echo " <tr>";
       echo "<td> $fila[Id]  </td> <td> $fila[Descripcion] </td>";
       echo " </tr>";

 }?></tbody></table><div class="col-md-6 col-sm-12"> <h5>Registrar Nueva Tela</h5><?php include('administrador/formte.php'); ?></div>

    </div>

    </article>

    <article id="aEntry">
      <?php include('administrador/movimientos/forme.php'); ?>
    </article>
    <article id="aSalida">
      <?php include('administrador/movimientos/forms.php'); ?>
    </article>

     <article style="display: none;" id="amovi">


        <table id="tm" class="table table-striped  table-hover" cellspacing="0" width="100%" >
          <thead><tr><th>Numero de Movimiento</th><th>Codigo de Barras</th><th>Movimiento</th><th>Cantidad</th><th>Usuario</th><th>Fecha</th><th>Detalles</th></tr></thead>
          <tbody>

            <?php

            $query = "SELECT * FROM hist_mov_ent_sal";
            $resultado = mysql_query($query);

            while ($fila = mysql_fetch_array($resultado)) {
              echo " <tr>";
              echo "<td> $fila[id] </td><td> $fila[codigo_id]  </td> <td> $fila[tipo_mov] </td><td> $fila[cantidad] </td><td> $fila[usuario] </td><td> $fila[fecha]</td><td class='campo_actualizable'>  <textarea class='form-control campo' rows='5' > $fila[detalles] </textarea>
                    <button data-id='$fila[id]' class='actualizar_campo btn btn-success'>Actualizar</button>  </td>";
              echo " </tr>";
            }
         ?></tbody></table>



     </article>


</section>
<div align="center"> <p><h2><img src="../images/logo.png" alt="" width="5%"> <h4 id="titleContento">LanderCorp.mx</h4> &reg 2015<p> </div>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./Signin Template for Bootstrap_files/ie10-viewport-bug-workaround.js"></script>


 </div>

  </div>
  <!-- /Demo content -->



</body>
</html>
