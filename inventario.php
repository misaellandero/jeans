<!doctype html>
<html lang="es">
<head>
       <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>Sistema De Inventario</title>
    <link rel="stylesheet" type="text/css" href="styles/normalize.css">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="styles/jquery-ui-1.10.3.custom.css">
	<link rel="stylesheet" type="text/css" href="styles/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap-responsive.css">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap.css">

	<script src="scripts/jquery-1.9.1.js"></script>
	<script src="scripts/functions.js"></script>
	<script src="scripts/prefixfree.min.js"></script>
	<script src="scripts/jquery.dataTables.js"></script>
	<script src="scripts/jquery-ui-1.10.3.custom.js"></script>
	<script src="scripts/jquery-barcode.js"></script>
</head>
<body>
	<div id="mainWrapper">
	  <header>
	      <h1>Sistema de Inventario</h1>
      </header>
       <nav>
            <ul class="nav nav-tabs">
               <li class="active"><a href="#">Registrar</a></li>
               <li><a href="#">Buscar</a></li>
           </ul>
       </nav>
<header id="titleContent">Registrar Articulo</header>
<section>
			<article id="aRegister">
				<div class="row-fluid">
					<div class="span6">
					<form id="fRegister" class="form" name="form" action="" method="post">
     <p>
        <label for="area" name><label>
        <select id="area" class="area" name="area">
      	  <option value="0">Seleccione Area</value>
        </select> 
     </p>

 <p>
        <label for="boss" name><label>
        <select id="boss" class="boss" name="boss">
      	  <option value="0">Seleccione Encargado</value>
        </select> 
 </p>

 <p>
        <label for="name"><label>
        <input id="name" clas="name" name="name" type="text">
      	  
 </p>
  <p>
        <label for="serial"><label>
        <input id="serial" clas="serial" name="serial" type="text">
      	  
 </p>

<p>
        <label for="Descripsion"><label>
        <input id="Descripsion" clas="Descripsion" name="Descripsion" type="text">
      	  
 </p>
 <p>
        <label for="Color"><label>
        <input id="Color" clas="Color" name="Color" type="text">
      	  
 </p>
 <p>
        <label for="Modelo"><label>
        <input id="Modelo" clas="Modelo" name="Modelo" type="text">
      	  
 </p>
 <p>
        <label for="# serie"><label>
        <input id="# serie" clas="# serie" name="# serie" type="text">
      	  
 </p>
  <p>
        <label for="proveedo" name><label>
        <select id="proveedo" class="proveedo" name="proveedo">
      	  <option value="0">Seleccione proveedor</value>
        </select> 
 </p>
  <p>
        <label for="Unidad"><label>
        <input id="Unidad" clas="# serie" name="Unidad" type="text">
      	  
 </p>
 <p>
        <label for="Cantidad"><label>
        <input id="Cantidad" clas="Cantidad" name="Cantidad" type="Cantidad">
      	  
 </p>
	<p>
	   <textarea id="Observaciones" class="Observaciones" name="Observaciones"> </textarea>
	</p>

	<p>
	<input class="btn btn-danger" type="reset" value="limpiar"/>
	<input id="doRegister" class="btn" type="submit" value="Registrar"> 
	</p>
	<div class="alert"/></div>
</form>

					</div>
					<div class="span6">
						<div class="contentBarcode">
							<div class="barCode">
								<header><h4>Codigo</h4></header>
								<canvas id="registerBarcode" width="115" height="70"></canvas>
							</div>
							<a href="#" class="btn btn-primary">Guardar</a>
							<div class="alert"></div>
						</div>
					</div>
				</div>
			</article>
			<article id="aSearch">
				<table id="tSearch" cellspacing="1">
	<caption>Lista de Articulos</caption>
	<thead>
		 <tr>
		 	<th>Id</th>
		 	<th>Área</th>
		 	<th>Encargado</th>
		 	<th>Descripsión</th>
		 	<th>Color</th>
		 	<th>Modelo</th>
		 	<th># serie</th>
		 	<th>proveedor</th>
		 	<th>Unidad</th>
		 	<th>Cantidad</th>
		 	<th>Encargado</th>
		 	<th>Observaciones</th>
		 </tr>
	</thead>
	<tbody>
	</tbody>
	</table>
	<div class="row-fluid">
					<div class="span6">
					<h3>Editar Articulo ART-<span></span></h3>
					    Ultima actualización:<i></i>
						<?php include 'form.php'; ?>
					</div>
					<div class="span6">
						<div class="contentBarcode">
							<div class="barCode">
								<header><h4>Codigo</h4></header>
								<canvas id="searchBarcode" width="115" height="70"></canvas>
							</div>
							<a href="#" class="btn btn-primary">Guardar</a>
							<div class="alert"></div>
						</div>
					</div>
				</div>
	</article>
</section>
	</div>
</body>
</html>
